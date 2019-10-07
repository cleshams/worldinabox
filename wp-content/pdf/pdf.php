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

// $lessonId = $_GET['lesson_id'];
// $warmup = $_GET['warmup_id'];
// $routine = $_GET['routine_id'];
// $game = $_GET['game_id'];

$lessonId = 380;


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
    $dompdf->set_option('isFontSubsettingEnabled', true);
    $dompdf->setPaper('A4', $orientation);
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->render();
    $dompdf->stream($title.'.pdf', array("Attachment" => false));
endif;