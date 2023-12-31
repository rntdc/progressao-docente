<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\Calendar;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtém o conteúdo do arquivo
        $conteudoDoArquivo = Storage::get('public/SIGAA.pdf');

        // Cria um arquivo temporário
        $tempFile = tempnam(sys_get_temp_dir(), 'temp_pdf');
        file_put_contents($tempFile, $conteudoDoArquivo);

        // Cria uma instância de UploadedFile
        $uploadedFile = new \Illuminate\Http\UploadedFile(
            $tempFile,
            'SIA.pdf',
            mime_content_type($tempFile),
            null,
            true
        );

        // Cria uma instância de Request e adiciona o arquivo
        $request = new Request();
        $request->files->add(['pdf' => $uploadedFile]);

        // Chama a função extractData com a instância da Request
        $this->extractData($request);

        // Retorna a view ou realiza outras operações, se necessário
        // return view('pdf');
    }

    public function extractData(Request $request)
    {
        //escrever validações se file é pdf e se file tem menos de 2MB

        $identifier = $this->identifyTypeOfData($request->file('pdf'));

        if($identifier === 'INVALID' ) {
            return redirect()->back()->with('error', 'Certifique-se de enviar um documento válido.');
        }

        $data = ($identifier['type'] === 'SIA') ? $this->extractDataPdfSia($identifier['text']) : $this->extractDataPdfSigaa($identifier['text']);

        print("<pre>".print_r($data,true)."</pre>");

        $sumHours = [];
/*
        foreach ($data as $item) {
            if (isset($sumHours[$item['semester']])) {
                $sumHours[$item['semester']] += $item['hours'];
            } else {
                $sumHours[$item['semester']] = $item['hours'];
            }
        }

        return view('data')->with('sumHours', $sumHours);
*/

    }

    public function identifyTypeOfData($file)
    {
        $pdfPath = $file->getRealPath();

        $config = new \Smalot\PdfParser\Config();
        $config->setHorizontalOffset('');

        $parser = new Parser([], $config);
        $pdf    = $parser->parseFile($pdfPath);

        $text = $pdf->getText();

        if (strpos($text, 'MINISTÉRIO DA EDUCAÇÃO') !== false) {
            return [
                'text' => $text,
                'type' => 'SIA'
            ];
        } elseif (strpos($text, 'Portal do Docente') !== false) {
            return [
                'text' => $text,
                'type' => 'SIGAA'
            ];
        } else {
            return 'INVALID';
        }
    }

    public function extractDataPdfSia($text)
    {

        // definir o padrão de expressão regular para extrair as linhas com dados numéricos
        $pattern = '/^(\d+)\s-\s(.+?)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+\/\d+)$/m';
        // encontrar todas as correspondências no texto extraído do PDF
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER, 0);

        $data = [];

        foreach ($matches as $match) {
            $curso = $match[2];
            $codigo = $match[3];
            $ch1 = $match[4];
            $ch2 = $match[5];
            $anoSemestre = $match[6];

            $data[] = [
                'code' => $codigo,
                'course' => $curso,
                'expectation' => $ch1,
                'hours' => $ch2,
                'semester' => $anoSemestre,
            ];
        }

        $semesters = Calendar::findSemestersBetween('2021-01-01', '2023-01-01');
        $start = Carbon::parse('2021-01-01');
        $end = Carbon::parse('2023-01-01');
        $totalHours = 0;

        foreach ($semesters as $key => $semester) {
            $semesterEnd = Carbon::parse($semester->end_date);
            $semesterStart = Carbon::parse($semester->start_date);
            $semesterToFilter = $semester->semester;

            $proportion = 1;

            if($key == 0 and $semesterStart->lessThanOrEqualTo($start)) {
                // logica: (start - semester->endDate) / 20
                $proportion = min(1, $start->diffInWeeks($semesterEnd) / 20);
            }

            if($key == count($semesters) - 1 and $semesterEnd->greaterThanOrEqualTo($end)) {
                // logica: (end - semester->startDate) / 20
                $proportion = min(1, $start->diffInWeeks($semesterStart) / 20);
            }

            $filteredData = array_filter($data, function ($curso) use ($semesterToFilter) {
                return $curso['semester'] == $semesterToFilter;
            });

            $sumHours = array_sum(array_column($filteredData, 'hours')) * $proportion;
            $totalHours += $sumHours;

            echo"<pre>";
            echo $semester->semester . " {$sumHours} <-> {$proportion} <br>";
            echo"</pre>";
        }

        echo $totalHours;
    }

    public function extractDataPdfSigaa($text)
    {
        $phrasesToRemove = [
            "/Portal do Docente.*?1050154, ministrou nesta instituição os seguintes componentes curriculares.*?letivos:/s",
            "/Porto Alegre,.*?Código de Verificação.*?Copyright ©.*?IFRS.*?sigprod-M4-host.inst1/s",
            "/Nível/s"
        ];

        foreach ($phrasesToRemove as $regex) {
            $text = preg_replace($regex, '', $text);
        }

        preg_match_all('/(\d{4}\.\d)/', $text, $matches, PREG_OFFSET_CAPTURE);
        $result = array();

        foreach ($matches[0] as $index => $match) {
            $semester = $match[0];
            $semester = str_replace('.', '/', $semester);
            $pos = $match[1];

            // Determine the text until the next semester (or until the end if it's the last semester)
            $nextPos = isset($matches[0][$index + 1]) ? $matches[0][$index + 1][1] : strlen($text);
            $length = $nextPos - $pos;

            // Extract the text for the current semester
            $semesterText = substr($text, $pos, $length);

            preg_match_all('/(\d+)\s*h/', $semesterText, $hourMatches);

            $sumHours = array_sum($hourMatches[1]);

            $result[$semester] = $sumHours;
        }

        $semesters = Calendar::findSemestersBetween('2021-01-01', '2023-01-01');
        $start = Carbon::parse('2021-01-01');
        $end = Carbon::parse('2023-01-01');
        $totalHours = 0;

        foreach ($semesters as $key => $semester) {
            $semesterEnd = Carbon::parse($semester->end_date);
            $semesterStart = Carbon::parse($semester->start_date);
            $semesterToFilter = $semester->semester;

            $proportion = 1;

            if($key == 0 and $semesterStart->lessThanOrEqualTo($start)) {
                // logica: (start - semester->endDate) / 20
                $proportion = min(1, $start->diffInWeeks($semesterEnd) / 20);
            }

            if($key == count($semesters) - 1 and $semesterEnd->greaterThanOrEqualTo($end)) {
                // logica: (end - semester->startDate) / 20
                $proportion = min(1, $start->diffInWeeks($semesterStart) / 20);
            }

            $filteredData = array_filter($result, function ($key) use ($semesterToFilter) {
                return $key == $semesterToFilter;
            }, ARRAY_FILTER_USE_KEY);

            // Output the filtered data
            print_r($filteredData);

            $sumHours = array_sum(array_column($filteredData, 'hours')) * $proportion;
            $totalHours += $sumHours;

            echo"<pre>";
            echo $semester->semester . " {$sumHours} <-> {$proportion} <br>";
            echo"</pre>";
        }


        return $result;

    }
}
