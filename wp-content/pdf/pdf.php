<?php
require 'vendor/autoload.php';
// debug (render as standard html)
// $mode = 'debug';
$mode = 'pdf';

if(isset($_GET['debug']))
{
	$mode = 'debug';
}


// bootstrap wordpress
header('Content-Type: text/html; charset=utf-8');
$parse_uri = explode('pdf', dirname(__FILE__));
$dir = $parse_uri[0];
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');


/************ */
/* Lesson Content 
/************ */

$lessonId = $_POST['pdf-lesson'];
$selectedWarmup = $_POST['pdf-warmup'];
$selectedGame = $_POST['pdf-game'];
$followAlong = $_POST['pdf-routine'];


$footerLogo = 'assets/images/movema-logo.svg';
$swooshYellow = 'assets/images/swoosh-yellow.svg';
$swooshPurple = 'assets/images/swoosh-purple.svg';
$mainLogo = 'assets/images/logo.svg';


/************ */
/* PDF Build 
/************ */
$orientation = 'landscape';

if($mode != 'debug'):
    $dompdf = new Dompdf\Dompdf();
    ob_start();
endif;

require('template_lesson.php');

if($mode != 'debug') :
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->set_option('defaultMediaType', 'all');
    $dompdf->set_option('isPhpEnabled', true);
    $dompdf->set_option('isFontSubsettingEnabled', false);
    $dompdf->setPaper('A4', $orientation);
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->render();
    $dompdf->stream($title.'.pdf', array("Attachment" => false));
endif;