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


//$section->addText('RAZON SOCIAL: DE OSMA ELIAS FELIPE','font-u-lg','text-center');

$section->addTextBreak();
$section->addText($nombre_emp,'font-md','text-center');
$section->addTextBreak();
$section->addText('Ficha N°: _________ '.$mes_anio,'font-md','text-left');
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

$cellColSpan1 = ['gridSpan' => 2, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellColSpan2 = ['gridSpan' => 3, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
$cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
$cellVCentered = ['valign' => 'center'];

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("I.S.S.S.P",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Ocupacion",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("F.Ingreso",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Remuneracion",'font-md');

$table2->addRow();
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($cargo,'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($fecha_inicio_num,'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($sueldo,'font-md');


$table2->addRow();
// celda 1
$cell1 = $table2->addCell(9000, $cellColSpan2);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText('VALUACIONES DE LOS TRABAJOS','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table2->addRow();
$cell2 = $table2->addCell(9000, $cellColSpan2);
$textrun2 = $cell2->addTextRun();
$textrun2->addText('Dias Basico','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table2->addRow();
$cell3 = $table2->addCell(9000, $cellColSpan2);
$textrun3 = $cell3->addTextRun();
$textrun3->addText('Horas Extra Basico','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($horas_ex,'font-md');

$table2->addRow();
$cell4 = $table2->addCell(9000, $cellColSpan2);
$textrun4 = $cell4->addTextRun();
$textrun4->addText('Bonificaciones','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($bonif,'font-md');

$table2->addRow();
$cell5 = $table2->addCell(9000, $cellColSpan2);
$textrun5 = $cell5->addTextRun();
$textrun5->addText('Horas Extra Bonif','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table2->addRow();
$cell6 = $table2->addCell(9000, $cellColSpan2);
$textrun6 = $cell6->addTextRun();
$textrun6->addText('___________','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');


$table2->addRow();
$cell7 = $table2->addCell(9000, $cellColSpan2);
$textrun7 = $cell7->addTextRun();
$textrun7->addText('Comisiones','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');


$table2->addRow();
$cell8 = $table2->addCell(9000, $cellColSpan2);
$textrun8 = $cell8->addTextRun();
$textrun8->addText('Vacaciones','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table2->addRow();
$cell9 = $table2->addCell(9000, $cellColSpan2);
$textrun9 = $cell9->addTextRun();
$textrun9->addText('Otros','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($otros,'font-md');


$table2->addRow();
$cell10 = $table2->addCell(9000, $cellColSpan2);
$textrun10 = $cell10->addTextRun('text-right');
$textrun10->addText('Total Remuneracion','font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($total_boleta,'font-md');

$section->addTextBreak(1);
$table3 = $section->addTable($table2StyleName);

$table3->addRow();
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DESCUENTOS",'font-md','text-center');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("EMPLEADOR",'font-md','text-center');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("EMPLEADO",'font-md');

$table3->addRow();
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Adelantos",'font-md');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("S. S. C.",'font-md');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_ss,'font-md','text-right');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_ss,'font-md');

$table3->addRow();
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Sis. Nac. Pens.",'font-md');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_pen,'font-md','text-right');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_pen,'font-md');

$table3->addRow();
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("C-No 19838",'font-md');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("0.00",'font-md','text-right');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("0.00",'font-md');

$table3->addRow();
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Imp. a la Renta",'font-md');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table3->addRow();
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("Otros",'font-md');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_ap_fon,'font-md','text-right');
$table3->addCell(4000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($dsc_at_fon,'font-md');



$section->addTextBreak(1);
$table5 = $section->addTable();
$table5->addRow();
$table5->addCell(4500)->addText("--------------------",'font-md','text-center');
$table5->addCell(4500)->addText("--------------------",'font-md','text-center');

$table5->addRow();
$table5->addCell(4500)->addText($nombre_emp,'font-md','text-center');
$table5->addCell(4500)->addText("RECIBI CONFORME",'font-md','text-center');



//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi . '-BO9-'.$ruc.'-'.$mes_anio, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi .'-BO9-'.$ruc.'-'.$mes_anio
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
