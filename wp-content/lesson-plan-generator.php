<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

define('TCPDFPATH', ABSPATH . '/wp-content/TCPDF-master');

require_once(TCPDFPATH .'/tcpdf.php');

/************ */
/* DOCUMENT SETTINGS 
/************ */

$lessonId = 380;
$unit = get_field('unit', $lessonId);
$duration = get_field('duration', $lessonId);
$objectives = get_field('objectives', $lessonId);
$title = get_the_title($lessonId);
$lessonNum = get_field('lesson_number', $lessonId);

$new_moves = get_field('new_moves', $lessonId);
$video = get_field('video', $lessonId);
$placeholder = get_field(('video_placeholder'), $lessonId);
$creative_task = get_field('creative_task', $lessonId);
$resources = get_field('resources', $lessonId);
$additional_content = get_field('additional_content', $lessonId);
$popout = get_field('popout_message', $lessonId);

$unit = wp_get_post_terms($lessonId, 'unit');
$unitID = $unit[0]->term_id;
$unitNumber = get_field('unit_number','unit_'.$unitID);
$logo = get_field('unit_logo', 'unit_'.$unitID);
$unitColour = get_field('colour', 'unit_'.$unitID);

class MYPDF extends TCPDF
{

    public function Header()
    {
        $this->Image(THEME_IMAGES . '/pdf-header.png', 0, 0, 210, '', 'png', '', 'T', false, 120, 'C', false, false, 0, false, false, false);

        $this->SetFont('helvetica', '', 20);

        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer()
    {
        # Default is 15mm from base
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(34, 34, 34);
        $this->Cell(10, 10, '', 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        $this->Cell(50, 10, ''.$this->getPageNumGroupAlias().'/'.$this->getPageGroupAlias(), 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(90, 10, '', 0, 0, 'R', 0, '', 0, false, 'C', 'M');
        $this->Cell(50, 10, '© '.date('Y').' World in a Box', 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        $this->Cell(10, 10, '', 0, 0, 'R', 0, '', 0, false, 'T', 'M');
    }
}


$pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    
// -----------------------\
// Global Variables
// -----------------------/


$pdf->SetCreator('World in a Box');   $pdf->SetAuthor('World in a Box');    $pdf->SetTitle('Lesson Plan');    $pdf->SetSubject('Lesson Plan');    $pdf->SetKeywords('Movema, World In a Box, Dance, Lesson Plan');
    
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetHeaderMargin(20);

$pdf->setFontSubsetting(true);
$avantgardeReg = TCPDF_FONTS::addTTFfont(TCPDFPATH .'/fonts/avantGardeStd-reg.ttf', 'TrueTypeUnicode', '', 32);
$avantgardeBold = TCPDF_FONTS::addTTFfont(TCPDFPATH .'/fonts/avantGardeStd-bold.ttf', 'TrueTypeUnicode', '', 32);
$avantgardeBlack = TCPDF_FONTS::addTTFfont(TCPDFPATH .'/fonts/avantgardelt-black.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont($avantgardeReg, '', 14, '', false);
$pdf->setTextShadow(array('enabled'=>false));


$pdf->setPrintHeader(true);

$pdf->startPageGroup();
$pdf->SetMargins(0,0,0);
$pdf->setCellMargins(0,0,0,0);
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->AddPage();
$pdf->setPrintFooter(true);
$pdf->setColorArray('fill',array(120,120,120));


$titleCellContent = $title . ': Lesson Plan';
$themeCellContent = '<span class="text__blue text__light">Theme:</span> <span class="text__title">' . $unit[0]->name . '</span>';
$objectivesCellContent = '';
foreach($objectives as $objective)
{
    $objectivesCellContent .= '<p>'.$objective['objective'].'</p>';
}


//Title
$pdf->SetDrawColor(255,255,255);
$pdf->writeHTMLCell(150, 40, 73, 10, $titleCellContent, 0, 0,false,true, 'C');

//Theme
$pdf->writeHTMLCell(200, '', 10, 20, $themeCellContent, 0, 0, false, true, 'L');

//Objectives
$pdf->SetDrawColor(239,93,161);
$pdf->SetFillColor(255, 241,0);
// $pdf->MultiCell(60,0,'Objectives:', 0,'L',true,)(200, '', 10, 30, $objectivesCellContent, 0, 1, true, true, 'L');

// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
