<?php

require_once '../../vendor/assets/PHPWord/vendor/autoload.php';
require_once '../exportarWord.php';
require_once '../zipeaArchivo.php';
//require_once '../vendor/assets/PHPWord/lib/PhpOffice/PhpWord/PHPZip/src/ZipFile.php';

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\TablePosition;

$phpWord = new \PhpOffice\PhpWord\PhpWord();
$rutaFuente = '../../assets/fonts/typewriter/JMH Typewriter-Black.ttf';
$nombre_emp = $_POST["empresa"];
$nombre_afi = $_POST["afiliado"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$nombre_carpeta = $_POST["nombre_carpeta"];
$cargo = $_POST["cargo"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_final = $_POST["fecha_final"];
$fecha_inicio_num = $_POST["fecha_inicio_num"];
$fecha_final_num = $_POST["fecha_final_num"];
$fecha_footer = $_POST["fecha_footer"];


$sueldo = $_POST["sueldo_boleta"];
$rem_vac = $_POST["rm_vacacional_boleta"];
$reintegro = $_POST["reintegro_boleta"];
$horas_ex = $_POST["horaex_boleta"];
$bonif = $_POST["boni_boleta"];
$bonif_ali = $_POST["bonificacion_alimentos_boleta"];
$bonif_met = $_POST["bonificacion_metas_boleta"];
$bonif_log = $_POST["bonificacion_logros_boleta"];
$bonif_fes = $_POST["bonificacion_festivos_boleta"];
$pasajes = $_POST["bonificacion_pasajes_boleta"];
$uniforme = $_POST["bonificacion_uniforme_boleta"];
$otros = $_POST["otros_boleta"];

$total_boleta = $_POST["total_boleta"];
$total_neto_1 = $_POST["total_neto_1"];
$mes_anio = $_POST["mes_anio"];

$ruc = $_POST["ruc"];

//Descuentos Porcentaje
$dsc_at_pen = $_POST["dsc_at_pen"];
$dsc_ap_pen = $_POST["dsc_ap_pen"];
$dsc_at_ss = $_POST["dsc_at_ss"];
$dsc_ap_ss = $_POST["dsc_ap_ss"];
$dsc_at_fon = $_POST["dsc_at_fon"];
$dsc_ap_fon = $_POST["dsc_ap_fon"];

$tot_dsc_at = $_POST["tot_desc_at"];
$tot_dsc_ap = $_POST["tot_desc_ap"];
$total_neto_bol = $_POST["total_neto_boleta"];

// Convertir las cadenas a números flotantes
$numero1 = floatval($tot_dsc_at);
$numero2 = floatval($tot_dsc_ap);

$suma = $numero1 + $numero2;

// Formatear el resultado con dos decimales
$total_dsc_at_ap = number_format($suma, 2);



//$zipFile = new \PhpZip\ZipFile();
$section = $phpWord->addSection(array('marginTop'=>2000));
// Crear una imagen como marca de agua
// $header = $section->createHeader();
// $header->addImage('../../view/images/bola.png',
//     array(
//         'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
//         'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_LEFT,
//         'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
//         'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
//         'marginRight'       => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(2.5),
//         'marginTop'        => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(1),
//     )
// );
$footer = $section->createFooter();

$phpWord->setDefaultFontName('Gill Sans MT');
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>32));
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>24));
$phpWord->addFontStyle('font-lg', array('bold'=>true, 'italic'=>false, 'size'=>12));
$phpWord->addFontStyle('font-md', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addFontStyle('font-sm', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addParagraphStyle('text-left', array('align'=>'left', 'spaceAfter'=>100));

$phpWord->addFontStyle('font-md-ne', array('bold'=>true, 'italic'=>false, 'size'=>8));

$phpWord->addFontStyle('font-u-lg', array('bold'=>false, 'italic'=>false, 'size'=>12, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold'=>false, 'italic'=>false, 'size'=>8, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('pnStyle', array('align'=>'left','indentation' => array('left' => 250), 'spacing'=>150));




$section->addText('BOLETA DE PAGO DEL TRABAJADOR - EMPLEADOS Y OBREROS','font-lg','text-center');


$tableStyleName = 'tabla_1';
$tableStyle = ['borderTopSize' => 12, 
                'borderBottomSize' => 12, 
                'borderColor' => '000000', 
                'cellMargin' => 0, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 5];
//$tableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
$tableCellStyle = ['valign' => 'center'];
$tableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
$tableFontStyle = ['bold' => true];

//$phpWord->addTableStyle($tableStyleName, $tableStyle, $tableFirstRowStyle);
$phpWord->addTableStyle($tableStyleName, $tableStyle);
//$table = $section->addTable($tableStyleName);
$table = $section->addTable();
$table->addRow();
$table->addCell(4500)->addText("DATOS DE LA EMPRESA",'font-md-ne');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addRow();
$table->addCell(4500)->addText("RAZON SOCIAL",'font-md');
$table->addCell(4500)->addText($nombre_emp,'font-md');
$table->addRow();
$table->addCell(4500)->addText("REG. PATRONAL LIB. TRIB. DIR",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addRow();
$table->addCell(4500)->addText("DATOS DEL TRABAJADOR",'font-md-ne');
$table->addCell(4500)->addText("",'font-md');
$table->addRow();
$table->addCell(4500)->addText("NOMBRE",'font-md');
$table->addCell(4500)->addText($nombre_afi,'font-md');
$table->addRow();
$table->addCell(4500)->addText("CATEG. Y OCUPACION",'font-md');
$table->addCell(4500)->addText($cargo,'font-md');
$table->addCell(4500)->addText(" FECHA DE INGRESO",'font-md');
$table->addCell(4500)->addText($fecha_inicio_num,'font-md');
$table->addRow();
$table->addCell(4500)->addText("FECHA DE NACIMIENTO",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("I.E.F.CESE",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addRow();
$table->addCell(4500)->addText("N° S. SOCIAL",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("",'font-md');

// ----------------------------------------------------
$section->addTextBreak(1);

$table2StyleName = 'tabla_2';
$table2Style = ['borderSize' => 0, 
                'borderColor' => '004455', 
                'borderStyle' => 'single',
                'cellMargin' => 0, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 0,
                'position' => ['vertAnchor' => TablePosition::VANCHOR_TEXT, 'bottomFromText' => Converter::cmToTwip(1)]
            ];

$phpWord->addTableStyle($table2StyleName, $table2Style);
$table2 = $section->addTable($table2StyleName);

$cellColSpan1 = ['gridSpan' => 3, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellColSpan2 = ['gridSpan' => 4, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
$cellVCentered = ['valign' => 'center'];

$table2->addRow();
// celda 1
$cell1 = $table2->addCell(9000, $cellColSpan1);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText('REMUNERACIONES','font-md-ne');

$table2->addRow();
// celda 1
$cell2 = $table2->addCell(9000, $cellColSpan1);
$textrun2 = $cell2->addTextRun($cellHCentered);
$textrun2->addText('SEMANA N°_____ DEL HASTA_______','font-md-ne');
// celda 2
// $cell2 = $table2->addCell(3000, $cellColSpan2);
// $textrun2 = $cell2->addTextRun($cellHCentered);
// $textrun2->addText('DESCUENTOS','font-md');


$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Haber Mensual",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($sueldo,'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Jornal",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Hrs. Trab. Días",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Dominical",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Horas Extras",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($horas_ex,'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Asig. Familiar",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Participacion Utilidades",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Feriados",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Bonificaciones",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($bonif,'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Reintegros",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($reintegro,'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Vacaciones",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($rem_vac,'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Otros",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($otros,'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');


$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("TOTALES HABER",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($total_boleta,'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$section->addTextBreak(1);

$table3 = $section->addTable($table2StyleName);
$table3->addRow();
// celda 1
$cell1 = $table3->addCell(9000, $cellColSpan2);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText('DESCUENTOS','font-md-ne');



$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md', 'text-center');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("EMPLEADOR",'font-md-ne', 'text-center');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("TRABAJADOR",'font-md-ne', 'text-center');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("TOTAL",'font-md-ne', 'text-center');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Seguro Social",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_ss,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_ss,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Enf. Maternidad",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Sis. Nac. D Pens",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_pen,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_pen,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Imp. Unico",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Acc. de Trabajo",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Fonavi",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_fon,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_fon,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Ley 19839",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Mandato Judicial",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Senati",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Adelanto",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table3->addRow();
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($tot_dsc_ap,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($tot_dsc_at,'font-md');
$table3->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($total_dsc_at_ap,'font-md');

$section->addTextBreak(2);
$section->addText('NETO RECIBIDO S/'.$total_neto_bol,'font-md','text-left');
$section->addText($mes_anio,'font-md','text-left');

$section->addTextBreak(2);
$table5 = $section->addTable();
$table5->addRow();
$table5->addCell(4500)->addText("--------------------",'font-md','text-center');
$table5->addCell(4500)->addText("--------------------",'font-md','text-center');

$table5->addRow();
$table5->addCell(4500)->addText($nombre_emp,'font-md','text-center');
$table5->addCell(4500)->addText($nombre_afi,'font-md','text-center');


//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi . '-BO12-'.$ruc.'-'.$mes_anio, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi .'-BO12-'.$ruc.'-'.$mes_anio
);

// Convertir el array asociativo a JSON
echo json_encode($responseData);
/*if( $creacion_carpeta['status'] == 0 )
{
    $archivos_a_zip = [];
    for ($i=0; $i < 5; $i++) {
        $name_file = strtotime("now");
        $archivos_a_zip[$i] = $name_file . ".docx";
        exportarWord::write($phpWord, $directorio . $nombre_carpeta, strtotime("now"), $writers);
        sleep(1);
    }
}*/

//$zipFile = new \PhpZip\ZipFile();
//$zipFile->addDirRecursive($creacion_carpeta['data']['archivo'])->saveAsFile($nombre_carpeta.".zip")->close();



//echo json_encode( zipeaArchivo::zipearArchivo($directorio . $nombre_carpeta, $nombre_carpeta.".zip") );
