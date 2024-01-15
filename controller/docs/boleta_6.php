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
$phpWord->addFontStyle('font-lg', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addFontStyle('font-md', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addFontStyle('font-sm', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addParagraphStyle('text-left', array('align'=>'left', 'spaceAfter'=>100));

$phpWord->addFontStyle('font-u-lg', array('bold'=>false, 'italic'=>false, 'size'=>10, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold'=>false, 'italic'=>false, 'size'=>8, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('pnStyle', array('align'=>'left','indentation' => array('left' => 250), 'spacing'=>150));

//$section->addText('B.S.013-72-','font-sm','text-right');
//$section->addText('RAZON SOCIAL: DE OSMA ELIAS FELIPE','font-u-lg','text-center');
$section->addTextBreak(0);
$section->addText('CONSTRUCTURA: '.$nombre_emp,'font-md','text-left');
$section->addTextBreak(0);
$section->addText('SUB_CONTRATISTA:___________REG PAT: _________','font-md','text-left');
$section->addTextBreak(0);
$section->addText('PLANILLA DE REMUNERACIONES:___________OBRA: _________   FONAV_____','font-md','text-left');

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
$table = $section->addTable($tableStyleName);

$cellColSpan1 = ['gridSpan' => 2, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellColSpan2 = ['gridSpan' => 3, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
$cellVCentered = ['valign' => 'center'];

$table->addRow();
// celda 1
$cell1 = $table->addCell(3000, $cellColSpan1);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText('','font-md');
// celda 2
$cell2 = $table->addCell(3000, $cellColSpan1);
$textrun2 = $cell2->addTextRun($cellHCentered);
$textrun2->addText($nombre_afi,'font-md');
// celda 3
$cell3 = $table->addCell(3000, $cellColSpan1);
$textrun3 = $cell3->addTextRun($cellHCentered);
$textrun3->addText($cargo,'font-md');

$table->addRow();
// celda 1
$cell4 = $table->addCell(3000, $cellColSpan1);
$textrun4 = $cell4->addTextRun($cellHCentered);
$textrun4->addText('CODIGO','font-md');
// celda 2
$cell5 = $table->addCell(3000, $cellColSpan1);
$textrun5 = $cell5->addTextRun($cellHCentered);
$textrun5->addText('NOMBRES Y APELLIDOS','font-md');
// celda 3
$cell6 = $table->addCell(3000, $cellColSpan1);
$textrun6 = $cell6->addTextRun($cellHCentered);
$textrun6->addText('OCUPACION','font-md');


$table->addRow();
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($fecha_inicio,'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table->addRow();
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("FECHA INGRESO",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("CARNET S.S.P",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DOC. IDENT.",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("MOTIVO INA.",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("C.C",'font-md');
$table->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("SALARIO",'font-md');

$section->addTextBreak(1);
$table2 = $section->addTable($tableStyleName);

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("TARIFA/SA",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("VAC.SALIDA",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("VAC.RETORNO",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("LICENCIA DEL",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("LICENCIA AL ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("FECHA DE CESE",'font-md');


$section->addTextBreak(1);
$table3 = $section->addTable($tableStyleName);

$table3->addRow();
// celda 1
$cell7 = $table3->addCell(6000, $cellColSpan2);
$textrun7 = $cell7->addTextRun($cellHCentered);
$textrun7->addText('','font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DESC. TRABAJADOR",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("APORTE EMPLEADOR",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("CONCEPTOS",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("HORAS",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("IMPORTE",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("JORNAL",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($sueldo,'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DOMINICAL",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DINERO de EXTRAS 100%",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("EXTRAS",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DESGASTE HERRAMIENTAS Y ROPA",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("ALZA DE TRANSPORTES",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("PASAJES",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("BONIFICACION ESPECIAL DL 22462",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("BONIFICACION ESPECIAL DL 22593",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("BONIFICACION ESPECIAL DL 22690",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("BONIFICACION ESPECIAL DL 22848.22978",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("SEGURO SOCIAL DEL PERU ",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_ss,'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_ss,'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("SISTEMA NACIONAL DE PENSIONES",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_pen,'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_pen,'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("IMPUESTO A LA REMUNERACION",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("FONDO NACIONAL DE VIVIENDA",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_fon,'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_fon,'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("CONAFICFR",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("ACCIDENTES DEL TRABAJO",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("______ ANT O ACT.5",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table3->addCell(2000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');


$section->addTextBreak(1);
$table4 = $section->addTable($tableStyleName);

$table4->addRow();
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table4->addRow();
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("5000",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1000",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("500",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("200",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("100",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("50",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("10",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("5",'font-md');
$table4->addCell(1000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1",'font-md');



$section->addTextBreak(1);
$table5 = $section->addTable();
$table5->addRow();
$table5->addCell(6000)->addText("--------------------",'font-md','text-center');
$table5->addCell(6000)->addText("--------------------",'font-md','text-center');

$table5->addRow();
$table5->addCell(6000)->addText($nombre_emp,'font-md','text-center');
$table5->addCell(6000)->addText("TRABAJADOR",'font-md','text-center');


//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi . '-BO6-'.$ruc.'-'.$mes_anio, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi .'-BO6-'.$ruc.'-'.$mes_anio
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
