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
$phpWord->addFontStyle('font-lg', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addFontStyle('font-md', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addFontStyle('font-sm', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addParagraphStyle('text-left', array('align'=>'left', 'spaceAfter'=>100));

$phpWord->addFontStyle('font-md-ne', array('bold'=>true, 'italic'=>false, 'size'=>8));

$phpWord->addFontStyle('font-u-lg', array('bold'=>true, 'italic'=>false, 'size'=>10, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold'=>false, 'italic'=>false, 'size'=>8, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('pnStyle', array('align'=>'left','indentation' => array('left' => 250), 'spacing'=>150));


//$section->addText('B.S.013-72-','font-sm','text-right');
//$section->addText('RAZON SOCIAL: DE OSMA ELIAS FELIPE','font-u-lg','text-center');

$section->addTextBreak(1);
$section->addText('Liquidacion de Pago','font-u-lg','text-center');
$section->addTextBreak(1);
$section->addText('SIMA-PERU','font-md','text-left');

$tableStyleName = 'tabla_1';
/*$tableStyle = ['borderTopSize' => 12, 
                'borderBottomSize' => 12, 
                //'borderColor' => '000000', 
                'cellMargin' => 0, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 5];*/
$tableStyle = ['borderSize' => 0, 
                'borderColor' => '004455', 
                'borderStyle' => 'single',
                'cellMargin' => 0, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 0,
                'position' => ['vertAnchor' => TablePosition::VANCHOR_TEXT, 'bottomFromText' => Converter::cmToTwip(1)]
                ];
//$tableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
$tableCellStyle = ['valign' => 'center'];
$tableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
$tableFontStyle = ['bold' => true];


$cellColSpan1 = ['gridSpan' => 2, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellColSpan2 = ['gridSpan' => 3, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellColSpan3 = ['gridSpan' => 6, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
$cellVCentered = ['valign' => 'center'];
//$phpWord->addTableStyle($tableStyleName, $tableStyle, $tableFirstRowStyle);
$phpWord->addTableStyle($tableStyleName, $tableStyle);
$table = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table->addRow();
$table->addCell(2000)->addText("",'font-md', $cellHCentered);
$table->addCell(2000)->addText($nombre_afi,'font-md', $cellHCentered);
$table->addCell(2000)->addText("IPSS",'font-md', $cellHCentered);
$table->addCell(2000)->addText("",'font-md', $cellHCentered);
$table->addCell(2000)->addText("",'font-md', $cellHCentered);
$table->addCell(2000)->addText("",'font-md', $cellHCentered);
$table->addCell(2000)->addText("",'font-md', $cellHCentered);
$table->addRow();
$table->addCell(2000)->addText("Codigo",'font-md', $cellHCentered);
$table->addCell(2000)->addText("Apellidos y Nombres",'font-md', $cellHCentered);
$table->addCell(2000)->addText("----",'font-md', $cellHCentered);
$table->addCell(2000)->addText("Taller",'font-md', $cellHCentered);
$table->addCell(2000)->addText("Pago Del ",'font-md', $cellHCentered);
$table->addCell(2000)->addText("Al",'font-md', $cellHCentered);
$table->addCell(2000)->addText("Fecha de Pago",'font-md', $cellHCentered);

$section->addTextBreak(1);
$table2 = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table2->addRow();
$table2->addCell(2000)->addText("",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("",'font-md', $cellHCentered);
$table2->addCell(2000)->addText($cargo,'font-md', $cellHCentered);
$table2->addCell(2000)->addText("",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("",'font-md', $cellHCentered);
$table2->addRow();
$table2->addCell(2000)->addText("Clave de Pago",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("Planilla",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("SEM",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("Cargo Especialidad",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("Nivel",'font-md', $cellHCentered);
$table2->addCell(2000)->addText("----",'font-md', $cellHCentered);

$section->addTextBreak(1);
$table3 = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table3->addRow();
$table3->addCell(2000)->addText("",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("",'font-md', $cellHCentered);
$table3->addRow();
$table3->addCell(2000)->addText("12 AC",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("Centro De",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("Division",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("Departamentos",'font-md', $cellHCentered);
$table3->addCell(2000)->addText("------",'font-md', $cellHCentered);

$section->addTextBreak(1);
$table4 = $section->addTable($tableStyleName);
$table4->addRow();
$table4->addCell(2000)->addText($fecha_inicio_num,'font-md', $cellHCentered);
$table4->addCell(2000)->addText("",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("",'font-md', $cellHCentered);
$table4->addCell(2000)->addText($bonif,'font-md', $cellHCentered);
$table4->addCell(2000)->addText($rem_vac,'font-md', $cellHCentered);
$table4->addRow();
$table4->addCell(2000)->addText("Fecha de Ingreso",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("Fecha De",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("Fecha De",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("Fecha De",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("Fecha De",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("Bonificacion",'font-md', $cellHCentered);
$table4->addCell(2000)->addText("Rem Vacacional",'font-md', $cellHCentered);

$section->addTextBreak(1);
$table5 = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table5->addRow();
$table5->addCell(2000)->addText($otros,'font-md', $cellHCentered);
$table5->addCell(2000)->addText("",'font-md', $cellHCentered);
$table5->addCell(2000)->addText("",'font-md', $cellHCentered);
$table5->addCell(2000)->addText("",'font-md', $cellHCentered);
$table5->addCell(2000)->addText($sueldo,'font-md', $cellHCentered);
$table5->addRow();
$table5->addCell(2000)->addText("Otros",'font-md', $cellHCentered);
$table5->addCell(2000)->addText("Saldo",'font-md', $cellHCentered);
$table5->addCell(2000)->addText("Adelanto",'font-md', $cellHCentered);
$table5->addCell(2000)->addText("Importe",'font-md', $cellHCentered);
$table5->addCell(2000)->addText("Jornal",'font-md', $cellHCentered);

$section->addTextBreak(1);
$table6 = $section->addTable($tableStyleName);
$table6->addRow();
$cell1 = $table6->addCell(12000, $cellColSpan3);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText('Ingresos','font-md-ne');
$table6->addRow();
$table6->addCell(2000)->addText("Concepto",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("Importe",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("Concepto",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("Importe",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("Concepto",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("Importe",'font-md', $cellHCentered);
$table6->addRow();
$table6->addCell(2000)->addText("",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("",'font-md', $cellHCentered);
$table6->addCell(2000)->addText("",'font-md', $cellHCentered);


$section->addTextBreak(1);
$table7 = $section->addTable($tableStyleName);
$table7->addRow();
$cell2 = $table7->addCell(12000, $cellColSpan3);
$textrun2 = $cell2->addTextRun($cellHCentered);
$textrun2->addText('Descuentos','font-md-ne');
$table7->addRow();
$table7->addCell(2000)->addText("Concepto",'font-md', $cellHCentered);
$table7->addCell(2000)->addText("Importe",'font-md', $cellHCentered);
$table7->addCell(2000)->addText("Concepto",'font-md', $cellHCentered);
$table7->addCell(2000)->addText("Importe",'font-md', $cellHCentered);
$table7->addCell(2000)->addText("Concepto",'font-md', $cellHCentered);
$table7->addCell(2000)->addText("Importe",'font-md', $cellHCentered);
$table7->addRow();
$table7->addCell(2000)->addText("SNP",'font-md', $cellHCentered);
$table7->addCell(2000)->addText($dsc_at_pen,'font-md', $cellHCentered);
$table7->addCell(2000)->addText("FONAVI",'font-md', $cellHCentered);
$table7->addCell(2000)->addText($dsc_at_fon,'font-md', $cellHCentered);
$table7->addCell(2000)->addText("IPSS",'font-md', $cellHCentered);
$table7->addCell(2000)->addText($dsc_at_ss,'font-md', $cellHCentered);


$section->addTextBreak(1);
$table8 = $section->addTable($tableStyleName);
$table8->addRow();
$cell3 = $table8->addCell(6000, $cellColSpan1);
$textrun3 = $cell3->addTextRun($cellHCentered);
$textrun3->addText('APORTACIONES EMPLEADOR','font-md-ne');
$table8->addCell(3000)->addText("",'font-md', );
$table8->addCell(3000)->addText("",'font-md', );
$table8->addRow();
$table8->addCell(3000)->addText("Concepto",'font-md-ne');
$table8->addCell(3000)->addText("Importe",'font-md-ne');
$table8->addCell(3000)->addText("",'font-md-ne');
$table8->addCell(3000)->addText("",'font-md');

$table8->addRow();
$table8->addCell(3000)->addText("SNP",'font-md');
$table8->addCell(3000)->addText($dsc_ap_pen,'font-md');
$table8->addCell(3000)->addText("TOTAL INGRESOS",'font-md-ne');
$table8->addCell(3000)->addText($total_boleta,'font-md');

$table8->addRow();
$table8->addCell(3000)->addText("FONAVI",'font-md');
$table8->addCell(3000)->addText($dsc_ap_fon,'font-md');
$table8->addCell(3000)->addText("TOTAL DESCUENTOS",'font-md-ne');
$table8->addCell(3000)->addText($total_dsc_at_ap,'font-md');



$table8->addRow();
$table8->addCell(3000)->addText("IPSS",'font-md');
$table8->addCell(3000)->addText($dsc_ap_ss,'font-md');
$table8->addCell(3000)->addText("NETO A PAGAR",'font-md-ne');
$table8->addCell(3000)->addText($total_neto_bol,'font-md');




//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi . '-BO17-'.$ruc.'-'.$mes_anio, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi .'-BO17-'.$ruc.'-'.$mes_anio
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
