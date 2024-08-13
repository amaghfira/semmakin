<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// panggil autoload dompdf nya
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf_creator {
    public function generate($html, $filename='', $paper = 'A4', $orientation = 'portrait', $stream=TRUE)
    {   
        mb_internal_encoding('UTF-8');

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->setDefaultFont('Arial');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }

}