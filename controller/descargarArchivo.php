<?php

require_once '../vendor/assets/PHPWord/vendor/autoload.php';
require_once 'exportarWord.php';
require_once 'zipeaArchivo.php';
//require_once '../vendor/assets/PHPWord/lib/PhpOffice/PhpWord/PHPZip/src/ZipFile.php';

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\TablePosition;

$phpWord = new \PhpOffice\PhpWord\PhpWord();

//$zipFile = new \PhpZip\ZipFile();
$section = $phpWord->addSection(array('marginTop'=>2000));
// Crear una imagen como marca de agua
$header = $section->createHeader();
$header->addImage('../view/images/bola.png',
    array(
        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_LEFT,
        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'marginRight'       => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(2.5),
        'marginTop'        => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(1),
    )
);
$footer = $section->createFooter();

$phpWord->setDefaultFontName('Gill Sans MT');
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>32));
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>24));
$phpWord->addFontStyle('font-lg', array('bold'=>false, 'italic'=>false, 'size'=>16));
$phpWord->addFontStyle('font-md', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addFontStyle('font-sm', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addParagraphStyle('text-left', array('align'=>'left', 'spaceAfter'=>100));

$phpWord->addFontStyle('font-u-lg', array('bold'=>false, 'italic'=>false, 'size'=>16, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold'=>false, 'italic'=>false, 'size'=>12, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('pnStyle', array('align'=>'left','indentation' => array('left' => 250), 'spacing'=>150));

$section->addText('B.S.013-72-','font-sm','text-right');
$section->addText('RAZON SOCIAL: DE OSMA ELIAS FELIPE','font-u-lg','text-center');

$section->addTextBreak(1);
$section->addText('BOLETA DE PAGO DE REMUNERACIONES','font-u-md','text-center');

$section->addTextBreak(1);
$section->addText('FEBRERO-1973','font-md','text-left');

/*
Ejemplo de una tabla dinamica
$rows = 10;
$cols = 5;
$section->addText('Basic table', $header);

$table = $section->addTable();
for ($r = 1; $r <= $rows; ++$r) {
    $table->addRow();
    for ($c = 1; $c <= $cols; ++$c) {
        $table->addCell(1750)->addText("Row {$r}, Cell {$c}");
    }
}
*/

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
$table = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table->addRow();
$table->addCell(4500)->addText("Apellidos",'font-md');
$table->addCell(4500)->addText("Jaime Garcia",'font-md');
$table->addRow();
$table->addCell(4500)->addText("Apellidos",'font-md');
$table->addCell(4500)->addText("Jaime Garcia",'font-md');
$table->addRow();
$table->addCell(4500)->addText("Apellidos",'font-md');
$table->addCell(4500)->addText("Jaime Garcia",'font-md');
$table->addRow();
$table->addCell(4500)->addText("Apellidos",'font-md');
$table->addCell(4500)->addText("Jaime Garcia",'font-md');

$section->addTextBreak(1);
$section->addText('Descanso vacacional','font-md','text-left');
$table_1 = $section->addTable($tableStyleName);
$table_1->addRow();
$table_1->addCell(4500)->addText("Desde:",'font-md');
$table_1->addCell(4500)->addText("Hasta:",'font-md');

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
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("2400",'font-md','text-right');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("B.L. 77482",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("DOMINICAL",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("B.L. 19990",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("HORAS EXTRAS",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText(" ",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("FONAVI",'font-md');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("0.00",'font-md','text-right');
$table2->addCell(3000, ['valign' => 'center', 'cellMargin' => 80, 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("24.00",'font-md','text-right');

$section->addTextBreak(4);
$section->addText('_____________________','font-md','text-left');
$section->addText('DE OSMA ELIAS FELIPE,','font-md','text-left');
$section->addTextBreak(0);
$section->addText('_____________________','font-md','text-left');
$section->addText('RECIBI CONFORME','font-md','text-left');


//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//$targetFile = "../files/". strtotime("now") . ".docx";
//$targetFile = __DIR__ . "/results/{$filename}.{$extension}";

//crear carpeta zip
$directorio = "../files/";
$nombre_carpeta = "zip_" . strtotime("now");

$creacion_carpeta = zipeaArchivo::crearCarpeta( $directorio . $nombre_carpeta);

if( $creacion_carpeta['status'] == 0 )
{
    $archivos_a_zip = [];
    for ($i=0; $i < 5; $i++) {
        $name_file = strtotime("now");
        $archivos_a_zip[$i] = $name_file . ".docx";
        exportarWord::write($phpWord, $directorio . $nombre_carpeta, strtotime("now"), $writers);
        sleep(1);
    }
}else {
    echo  0;
}

//$zipFile = new \PhpZip\ZipFile();
//$zipFile->addDirRecursive($creacion_carpeta['data']['archivo'])->saveAsFile($nombre_carpeta.".zip")->close();

echo json_encode( zipeaArchivo::zipearArchivo($directorio . $nombre_carpeta, $nombre_carpeta.".zip") );
?>