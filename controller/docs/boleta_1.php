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


//$section->addText('B.S.013-72-','font-sm','text-right');
//$section->addText('RAZON SOCIAL: DE OSMA ELIAS FELIPE','font-u-lg','text-center');
// $section->addText($nombre_emp,'font-u-lg','text-left');
$section->addTextBreak(0);
$section->addText('RAZON SOCIAL: '.$nombre_emp,'font-lg-negrita','text-center');

$section->addTextBreak(0);
$section->addText('BOLETA DE PAGO DE REMUNERACION','font-md-negrita','text-center');

$section->addTextBreak(0);
$section->addText($mes_anio,'font-md-negrita','text-left');

$tableStyleName = 'tabla_1';
$tableStyle = [
    'borderTopSize' => 12,
    'borderBottomSize' => 12,
    'borderColor' => '000000',
    'cellMargin' => 40,
    'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
    'cellSpacing' => 5
];
//$tableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
$tableCellStyle = ['valign' => 'center'];
$tableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
$tableFontStyle = ['bold' => true];
//$phpWord->addTableStyle($tableStyleName, $tableStyle, $tableFirstRowStyle);
$phpWord->addTableStyle($tableStyleName, $tableStyle);
$table = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table->addRow();
$table->addCell(4500)->addText("Apellidos:", 'font-md');
$table->addCell(4500)->addText($apellido, 'font-md');
$table->addRow();
$table->addCell(4500)->addText("Nombres:", 'font-md');
$table->addCell(4500)->addText($nombre, 'font-md');
$table->addRow();
$table->addCell(4500)->addText("Cargo:", 'font-md');
$table->addCell(4500)->addText($cargo, 'font-md');
$table->addRow();
$table->addCell(4500)->addText("Ingreso", 'font-md');
$table->addCell(4500)->addText($fecha_inicio_num, 'font-md');

$section->addText('Descanso vacacional', 'font-md', 'text-left');
$table_1 = $section->addTable($tableStyleName);
$table_1->addRow();
$table_1->addCell(4500)->addText("Desde:", 'font-md');
$table_1->addCell(4500)->addText("Hasta:", 'font-md');

// ----------------------------------------------------

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
$cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
$cellVCentered = ['valign' => 'center'];

$table2->addRow();
// celda 1
$cell1 = $table2->addCell(3000, $cellColSpan1);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText('REMUNERACIONES','font-md');
// celda 2
$cell2 = $table2->addCell(3000, $cellColSpan1);
$textrun2 = $cell2->addTextRun($cellHCentered);
$textrun2->addText('DSCTO. EMPLEADOR','font-md');
// celda 3
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("TRABAJADOR",'font-md');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("HABER BASICO",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($sueldo,'font-md','text-right');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("B.L. 77482",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DOMINICAL",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md','text-right');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("B.L. 19990",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("HORAS EXTRAS",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($horas_ex,'font-md','text-right');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("FONAVI",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("0.00",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("0.00",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("ASIS. FAMILAI",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("B.L.18846",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("ALIMENTACION",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("ADELANTO",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("FALTAS",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("FERIADO",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("BONIFICACION",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($bonif,'font-md','text-right');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("MOVILIDAD",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("SUB-TOTALES",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($total_boleta,'font-md','text-right');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("--------",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("--------",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("--------",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("--------",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("--------",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("TOTALES",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText($total_boleta,'font-md','text-right');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("NETO A PAGAR",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("0",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md','text-right');


// Crea una tabla con 1 fila y 2 columnas
$section->addTextBreak(1);
$table3StyleName = 'tabla_3';
$table4Style = ['borderSize' => 0,
                'borderColor' => 'FFFFFF',
                'cellMargin' => 0,
            ];

$phpWord->addTableStyle($table3StyleName, $table4Style);

$table3 = $section->addTable($table3StyleName);
$table3->addRow();
$table3->addCell(4500)->addText('.................................', 'font-md', 'text-center');
$table3->addCell(4500)->addText('.................................', 'font-md', 'text-center');
$table3->addRow();
$table3->addCell(4500)->addText($nombre_emp, 'font-md', 'text-center');
$table3->addCell(4500)->addText('RECIBI CONFORME', 'font-md', 'text-center');



//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//$targetFile = "../files/". strtotime("now") . ".docx";
//$targetFile = __DIR__ . "/results/{$filename}.{$extension}";

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi . '-BO1-'.$ruc.'-'.$mes_anio, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi .'-BO1-'.$ruc.'-'.$mes_anio
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
