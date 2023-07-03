<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Smalot\PdfParser\Parser;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pdf');
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

        foreach ($data as $item) {
            if (isset($sumHours[$item['semester']])) {
                $sumHours[$item['semester']] += $item['hours'];
            } else {
                $sumHours[$item['semester']] = $item['hours'];
            }
        }

        return view('data')->with('sumHours', $sumHours);


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
                'ch1' => $ch1,
                'hours' => $ch2,
                'semester' => $anoSemestre,
            ];
        }

        return $data;
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
