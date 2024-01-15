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
$total_neto_bol = $_POST["total_neto_boleta"];


//$zipFile = new \PhpZip\ZipFile();
$section = $phpWord->addSection(array('marginTop' => 2000));
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

$phpWord->setDefaultFontName($rutaFuente);
$phpWord->addFontStyle('font-xxl', array('bold' => false, 'italic' => false, 'size' => 32));
$phpWord->addFontStyle('font-xxl', array('bold' => false, 'italic' => false, 'size' => 24));
$phpWord->addFontStyle('font-lg', array('bold' => false, 'italic' => false, 'size' => 16));
$phpWord->addFontStyle('font-md', array('bold' => false, 'italic' => false, 'size' => 12));
$phpWord->addFontStyle('font-sm', array('bold' => false, 'italic' => false, 'size' => 8));
$phpWord->addParagraphStyle('text-left', array('align' => 'left', 'spaceAfter' => 100));

$phpWord->addFontStyle('font-u-lg', array('bold' => false, 'italic' => false, 'size' => 16, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold' => false, 'italic' => false, 'size' => 12, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

$phpWord->addParagraphStyle('text-center', array('align' => 'center', 'spaceAfter' => 100));
$phpWord->addParagraphStyle('text-right', array('align' => 'right', 'spaceAfter' => 100));
$phpWord->addParagraphStyle('pnStyle', array('align' => 'left', 'indentation' => array('left' => 250), 'spacing' => 150));

$phpWord->addFontStyle('font-u-lg', array('bold'=>false, 'italic'=>false, 'size'=>16, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold'=>false, 'italic'=>false, 'size'=>12, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

//Me
$phpWord->addFontStyle('font-lg-negrita', array('bold'=>true, 'italic'=>false, 'size'=>16, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-md-justificado', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addParagraphStyle('sangria', array('indentation' => array('left' => 250), 'spacing'=>150));
$phpWord->addParagraphStyle('text-justify', array('align'=>'both'));

$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('indtStyle', array('align'=>'both','indentation' => array('left' => 900, 'right'=> 900), 'spacing'=>150));
$phpWord->addParagraphStyle('indtStyle-left', array('align'=>'both','indentation' => array('left' => 900, 'right'=> 900), 'spacing'=>150));
$phpWord->addParagraphStyle('indtStyle-le-min', array('align'=>'both','indentation' => array('left' => 1700, 'right'=> 900), 'spacing'=>150));
$phpWord->addParagraphStyle('indtStyle-right', array('align'=>'right','indentation' => array('left' => 900, 'right'=> 900), 'spacing'=>150));



$section->addTextBreak(0);
$section->addText('RAZON SOCIAL: '.$nombre_emp,'font-u-lg','text-center');

$section->addTextBreak(0);
$section->addText($mes_anio,'font-md','text-right');

$section->addTextBreak(0);
$section->addText('BOLETA DE PAGO ','font-u-lg','text-center');

$tableStyleName = 'tabla_1';
$tableStyle = ['borderTopSize' => 12, 
                'borderBottomSize' => 12, 
                'borderColor' => '000000', 
                'cellMargin' => 40, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 5];
//$tableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
$tableCellStyle = ['valign' => 'center'];
$tableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
$tableFontStyle = ['bold' => true];
//$phpWord->addTableStyle($tableStyleName, $tableStyle, $tableFirstRowStyle);
$phpWord->addTableStyle($tableStyleName, $tableStyle);

$tableStyleName2 = 'tabla_2';
$tableStyle = ['borderTopSize' => 12, 
                'borderBottomSize' => 12, 
                'borderColor' => 'FFFFFF', 
                'cellMargin' => 40, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 5];
//$tableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
$tableCellStyle = ['valign' => 'center'];
$tableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
$tableFontStyle = ['bold' => true];
//$phpWord->addTableStyle($tableStyleName, $tableStyle, $tableFirstRowStyle);
$phpWord->addTableStyle($tableStyleName, $tableStyle);
$table = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table->addRow();
$table->addCell(4500)->addText("Nombre Y Apellidos:",'font-md');
$table->addCell(4500)->addText($nombre_afi,'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addRow();
$table->addCell(4500)->addText("Cargo:",'font-md');
$table->addCell(4500)->addText($cargo,'font-md');
$table->addRow();
$table->addCell(4500)->addText("Fecha de Ingreso:",'font-md');
$table->addCell(4500)->addText($fecha_inicio,'font-md');
$table->addRow();
$table->addCell(4500)->addText("SUELDO:",'font-md');
$table->addCell(4500)->addText($sueldo,'font-md');
$table->addRow();
$table->addCell(4500)->addText("Rem. Vacacional:",'font-md');
$table->addCell(4500)->addText($rem_vac,'font-md');
$table->addRow();
$table->addCell(4500)->addText("Reintegro:",'font-md');
$table->addCell(4500)->addText($reintegro,'font-md');
$table->addRow();
$table->addCell(4500)->addText("H. Extras:",'font-md');
$table->addCell(4500)->addText($horas_ex,'font-md');
$table->addRow();
$table->addCell(4500)->addText("Otros:",'font-md');
$table->addCell(4500)->addText($otros,'font-md');
$table->addRow();
$table->addCell(4500)->addText("Total:",'font-md');
$table->addCell(4500)->addText($total_boleta,'font-md');
$table->addRow();
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("TRABAJADOR",'font-md');
$table->addCell(4500)->addText("EMPLEADOR",'font-md');
$table->addRow();
$table->addCell(4500)->addText("S.N.P.:",'font-md');
$table->addCell(4500)->addText($dsc_at_pen,'font-md');
$table->addCell(4500)->addText($dsc_ap_pen,'font-md');
$table->addRow();
$table->addCell(4500)->addText("IPSS:",'font-md');
$table->addCell(4500)->addText($dsc_at_ss,'font-md');
$table->addCell(4500)->addText($dsc_ap_ss,'font-md');
$table->addRow();
$table->addCell(4500)->addText("FONAVI:",'font-md');
$table->addCell(4500)->addText($dsc_at_fon,'font-md');
$table->addCell(4500)->addText($dsc_ap_fon,'font-md');
$table->addRow();
$table->addCell(4500)->addText("QUINCENA:",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addRow();
$table->addCell(4500)->addText("ADELANTO:",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addRow();
$table->addCell(4500)->addText("OTROS:",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addCell(4500)->addText("",'font-md');
$table->addRow(2);
$table->addCell(4500)->addText(" ",'font-md');
$table->addCell(4500)->addText("NETO A PAGAR",'font-md');
$table->addCell(4500)->addText($total_neto_bol,'font-md');


$section->addText('');
$table_1 = $section->addTable($tableStyleName2);
$table_1->addRow(3);
$table_1->addCell(4500)->addText("--------------------",'font-md','text-center');
$table_1->addCell(4500)->addText("--------------------",'font-md','text-center');
$table_1->addRow();
$table_1->addCell(4500)->addText("EMPRESA",'font-md','text-center');
$table_1->addCell(4500)->addText("TRABAJADOR",'font-md','text-center');

// $section->addTextBreak(0);
// $section->addText('RAZON SOCIAL: '.$nombre_emp,'font-u-lg','text-center');

// $section->addTextBreak(0);
// $section->addText('BOLETA DE PAGO DE REMUNERACION','font-u-lg','text-center');

// $section->addTextBreak(4);
// $section->addText($fecha_footer,'font-md','text-left');
// $section->addTextBreak(0);


//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi . '-BO2-'.$ruc.'-'.$mes_anio, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi .'-BO2-'.$ruc.'-'.$mes_anio
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
