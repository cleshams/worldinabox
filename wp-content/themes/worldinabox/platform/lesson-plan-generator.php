<?php
require_once(ABSPATH .'/wp-includes/TCPDF-master/tcpdf.php');

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
        $this->Cell(90, 10, '', 'B', 0, 'R', 0, '', 0, false, 'C', 'M');
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
$Gotham_reg = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'].'/wp-includes/TCPDF-master/fonts/Gotham_Medium_Regular.ttf', 'TrueTypeUnicode', '', 32);
$Gotham_bold = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'].'/wp-includes/TCPDF-master/fonts/Gotham-Bold.ttf', 'TrueTypeUnicode', '', 32);
$Gotham_thin = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'].'/wp-includes/TCPDF-master/fonts/Gotham-Thin.ttf', 'TrueTypeUnicode', '', 32);
$source_sans_thin = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'].'/wp-includes/TCPDF-master/fonts/SourceSansPro-Light.ttf', 'TrueTypeUnicode', '', 32);
$Gotham_italic = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'].'/wp-includes/TCPDF-master/fonts/Gotham_Medium_Italic.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont($Gotham_reg, '', 14, '', true);
// set text shadow effect
$pdf->setTextShadow(array('enabled'=>false,));
