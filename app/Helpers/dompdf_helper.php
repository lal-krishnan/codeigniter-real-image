<?php 

use Dompdf\Dompdf;
use Dompdf\Options;


function pdf_create($html, $filename='', $stream=TRUE) 
{
    $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // for loading images, etc.

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename, ["Attachment" => false]); // set true to force download
        } else {
            return $dompdf->output();
        }
}