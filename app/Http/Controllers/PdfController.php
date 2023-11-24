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
        $conteudoDoArquivo = Storage::get('public/SIA.pdf');

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

        /*
        // Sera criada um objeto para cada semestre, no caso esse representa o de 2021 para testes
        $semesterStart = Carbon::createFromFormat('d/m/Y', '13/03/2021');
        $semesterEnd = Carbon::createFromFormat('d/m/Y', '21/07/2021');

        $now = Carbon::now();
        $past = Carbon::now()->subYears(2);

        $start = $semesterStart->greaterThan($past) ? $semesterStart : $past;
        $end = $semesterEnd->lessThan($now) ? $semesterEnd : $now;

        $daysOverlap = $end->diffInDays($start) + 1;
        $daysOverlap = max(0, $daysOverlap);

        echo "Number of overlapping days: " . $daysOverlap . "<br>";;

        echo $now . "<br>";
        echo $past . "<br>";
        */

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
        $semestresDesejados = [];
        // Inicializar um array para armazenar a soma das horas por semestre
        $somaHorasPorSemestre = [];

        // Iterar sobre os cursos
        foreach ($data as $curso) {
            // Verificar se o semestre está nos semestres desejados
            if (in_array($curso['semester'], $semestresDesejados)) {
                // Se o semestre já existir no array, adicionar as horas
                if (isset($somaHorasPorSemestre[$curso['semester']])) {
                    $somaHorasPorSemestre[$curso['semester']] += $curso['hours'];
                } else {
                    // Se não, inicializar as horas para o semestre
                    $somaHorasPorSemestre[$curso['semester']] = $curso['hours'];
                }
            }
        }

        return $somaHorasPorSemestre;
    }

    public function extractDataPdfSigaa($text)
    {
        // Definir o padrão de expressão regular para extrair as linhas com dados numéricos
        $pattern = '/(\d+\.\d+)\tNível\t\n((?:.+\t.+\t)+)/m';
        // Encontrar todas as correspondências no texto extraído do PDF
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER, 0);

        $data = [];

        foreach ($matches as $match) {
            $semester = $match[1];
            $courses = explode("\n", trim($match[2]));

            foreach ($courses as $course) {
                //course data esta captando como indice 0 o nome do curso + horas e, como indice 1, o tipo do curso
                $courseData = explode("\t", $course);

                $courseName = $courseData[0];
                $hours = preg_replace("/[^0-9]/", "", $courseData[0]);
                $type = $courseData[1];

                $data[] = [
                    'semester' => $semester,
                    'course' => $courseName,
                    'hours' => $hours,
                    'type' => $type,
                ];
            }
        }
        return $data;
    }

}
