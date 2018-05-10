<?php

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();

$html = '';

//$document->loadHtml($html);
$page = file_get_contents("cat.html");

//$document->loadHtml($page);

$document->loadHtml('hola');

//set page size and orientation

$document->setPaper('A4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Reporte tecnico", array("Attachment"=>1));
//1  = Download
//0 = Preview


?>