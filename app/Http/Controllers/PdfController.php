<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Smalot\PdfParser\Parser;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function extractDataPdfSia()
    {
        $pdfPath = public_path('pdfs/sia.pdf');

        $parser = new Parser();

        $pdf = $parser->parseFile($pdfPath);
        $text = $pdf->getText();

        // Definir o padrão de expressão regular para extrair as linhas com dados numéricos
        $pattern = '/^(\d+)\s-\s(.+?)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+\/\d+)$/m';
        // Encontrar todas as correspondências no texto extraído do PDF
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER, 0);

        $data = [];
        $hours = 0;

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

        foreach ($matches as $match) {
            $curso = $match[2];
            $codigo = $match[3];
            $ch1 = $match[4];
            $ch2 = $match[5];
            $anoSemestre = $match[6];

            if($anoSemestre == "2019/1") {
                $hours += $ch2;
            }

            $data[] = [
                'codigo' => $codigo,
                'curso' => $curso,
                'ch1' => $ch1,
                'ch2' => $ch2,
                'anoSemestre' => $anoSemestre,
            ];
        }

        echo $hours;

        print("<pre>".print_r($data,true)."</pre>");
    }

    public function extractDataPdfSigaa()
    {
        $pdfPath = public_path('pdfs/sigaa.pdf');

        $config = new \Smalot\PdfParser\Config();
        $config->setHorizontalOffset('');

        $parser = new Parser([], $config);
        $pdf    = $parser->parseFile($pdfPath);

        $text = $pdf->getText();

        // Definir o padrão de expressão regular para extrair as linhas com dados numéricos
        $pattern = '/(\d{4}\.\d+)\s+Nível\s+(.+?)\s-\s(\d+)\sh\s+(\S+)/m';
        // Encontrar todas as correspondências no texto extraído do PDF
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER, 0);

        $data = [];

        foreach ($matches as $match) {
            $anoSemestre = $match[1];
            $subject  = $match[2];
            $hours = $match[3];
            $courseType  = $match[4];

            $data[] = [
                'tipo' => $courseType,
                'curso' => $subject,
                'horas' => $hours,
                'anoSemestre' => $anoSemestre,
            ];
        }

        print("<pre>".print_r($data,true)."</pre>");
    }

}
