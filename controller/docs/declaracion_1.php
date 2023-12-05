<?php

require_once '../../vendor/assets/PHPWord/vendor/autoload.php';
require_once '../exportarWord.php';
require_once '../zipeaArchivo.php';
//require_once '../vendor/assets/PHPWord/lib/PhpOffice/PhpWord/PHPZip/src/ZipFile.php';


$phpWord = new \PhpOffice\PhpWord\PhpWord();
//require_once '../vendor/assets/PHPWord/lib/PhpOffice/PhpWord/PHPZip/src/ZipFile.php';

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\TablePosition;

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$nombre_emp = $_POST["empresa"];
$nombre_afi = $_POST["afiliado"];
$nombre_carpeta = $_POST["nombre_carpeta"];
$cargo = $_POST["cargo"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_final = $_POST["fecha_final"];
$fecha_footer = $_POST["fecha_footer"];
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

$phpWord->setDefaultFontName('Roboto');
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>32));
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>24));
$phpWord->addFontStyle('font-lg', array('bold'=>false, 'italic'=>false, 'size'=>16));
$phpWord->addFontStyle('font-md', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addFontStyle('font-sm', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addParagraphStyle('text-left', array('align'=>'left', 'spaceAfter'=>100));

$phpWord->addFontStyle('font-u-lg', array('bold'=>false, 'italic'=>false, 'size'=>16, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold'=>false, 'italic'=>false, 'size'=>12, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

//Me
$phpWord->addFontStyle('font-lg-negrita', array('bold'=>true, 'italic'=>false, 'size'=>16, 'underline' =>\PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-md-justificado', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addParagraphStyle('sangria', array('indentation' => array('left' => 250), 'spacing'=>150));
$phpWord->addParagraphStyle('text-justify', array('align'=>'both'));

$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('pnStyle', array('align'=>'left','indentation' => array('left' => 250), 'spacing'=>150));


$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('pnStyle', array('align'=>'left','indentation' => array('left' => 250), 'spacing'=>150));

//$section->addText('B.S.013-72-','font-sm','text-right');
//$section->addText('RAZON SOCIAL: DE OSMA ELIAS FELIPE','font-u-lg','text-center');

$section->addTextBreak(0);
$section->addText('DECLARACIÓN JURADA DEL EMPLEADOR','font-lg-negrita','text-center');
$section->addText('(Supremo N° 054-07-Cf, Bono 1990)','font-md','text-center');
$section->addText('(Para Los Fines En La Segunda Disposición Final Y Transitoria Del Decreto)','font-md','text-center');


$section->addTextBreak(2);
$section->addText('Por la presente yo, identificado con D.N.I N° '.$nombre_afi.' en calidad de Representante Legal de la Empresa '.$nombre_emp. ' identificada con Registro Único de Contribuyente - R.U.C. - N°'.$cargo.'. Declaro bajo juramento que el señor(a) '.$nombre_afi.' identificado con'.$fecha_final.' código ESSALUD N°'.$fecha_final.' y Código Único del SPP (CUSPP) N°'.$fecha_final.' quien se encuentra tramitando el siguiente tipo de Bono de Reconocimiento.','font-md','text-left');

$section->addTextBreak(1);
$section->addText('Bono de Reconocimiento 1992 (Decreto Supremo N° 180-94-EF)','font-md','text-left');

$section->addTextBreak(1);
$section->addText('Bono de Reconocimiento 1998 (Decreto Supremo N° 054-97-EF)','font-md','text-left'); 

$section->addTextBreak(1);
$section->addText('Bono de Reconocimiento 2001 (Decreto Supremo N° 054-97-EF)','font-md','text-left');

$section->addTextBreak(1);
$section->addText('Ha laborado en esta empresa como se detalla a continución:','font-md','text-left');

//----TABLA 1-----//
$section->addTextBreak(1);
$section->addText('1. Meses Laborados (1)','font-md','text-left'); 

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
$textrun1->addText('DESDE','font-md');
// celda 2
$cell2 = $table2->addCell(3000, $cellColSpan1);
$textrun2 = $cell2->addTextRun($cellHCentered);
$textrun2->addText('HASTA','font-md');
// celda 3
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("N° DE MESES",'font-md','text-center');


$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("MES",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("AÑO",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("MES",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("AÑO",'font-md','text-center');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("",'font-md');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("5",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1958",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("5",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1990",'font-md','text-center');
$table2->addCell(3000, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("384",'font-md','text-center');

$section->addTextBreak(1);
$section->addText('1/ Incluir todos los meses efectivamente laborados. Incluso hasta la fecha, de ser el caso, para los casos de meses en que no se realizaron retenciones el trabajador sobre su remuneracion (p.e. Licencia sin goce de haber)','font-md','text-left');

//----TABLA 2-----//

$section->addTextBreak(1);
$section->addText('2. Últimas doce(12) Remuneraciones (2)','font-md','text-left'); 

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

// $cellColSpan1 = ['gridSpan' => 2, 'cellMargin' => 5, 'valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'];
// $cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
// $cellVCentered = ['valign' => 'center'];

// $table2->addRow();
// // celda 1
// $cell1 = $table2->addCell(3000, $cellColSpan1);
// $textrun1 = $cell1->addTextRun($cellHCentered);
// $textrun1->addText('DESDE','font-md');
// // celda 2
// $cell2 = $table2->addCell(3000, $cellColSpan1);
// $textrun2 = $cell2->addTextRun($cellHCentered);
// $textrun2->addText('HASTA','font-md');
// // celda 3


$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("MES",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("AÑO",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("REMUNERACIÓN (S/.) 2/",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("RETENCIÓN 3/",'font-md','text-center');


$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("12",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("91",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,920.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("57.60",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("01",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,020.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("30.60",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("02",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,395.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("41.85",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("03",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,196.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("35.88",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("04",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("2,060.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("61.80",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("05",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,120.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("33.60",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("06",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,280.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("38.40",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("07",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("860.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("25.80",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("08",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,010.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("30.30",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("09",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("860.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("25.80",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("10",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,252.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("37.56",'font-md','text-center');

$table2->addRow();
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("11",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("92",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("1,266.00",'font-md','text-center');
$table2->addCell(1500, ['valign' => 'center', 'borderSize' => 4, 'border-style' => 'single', 'borderColor' => '000000'])->addText("37.98",'font-md','text-center');

$section->addTextBreak(1);
$section->addText('1/ Solo llenar para el caso de las generadas con anterioridad al 06 de Dic. 92, consecutivo o no.','font-md','text-left');

$section->addTextBreak(1);
$section->addText('2/ Considerese como remuneración, todos los pagos realizados en ese mes( Básico, gratificaciones, etc.) que estuvieron afectos al descuento por IPSS-Pensiones.','font-md','text-left');

$section->addTextBreak(1);
$section->addText('3/ Señalar la retención efectuada al trabajador por concepto de pensiones IPSS, sobre la remuneración de ese mes.','font-md','text-left');
//----------------//

$section->addTextBreak(1);
$section->addText('Por lo demás, declaro que en los meses a que se hace referencia anteriormente se ha realizado las retenciones por concepto de los aportes a algunos de los Sistemas de Pensiones administrados por la ONP.','font-md','text-left');


$section->addTextBreak(4);
$section->addText('_____________________','font-md','text-right');
$section->addText('Firma y Sello del ','font-md','text-right');
$section->addText('Representante legal','font-md','text-right');
$section->addTextBreak(0);

//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//$targetFile = "../files/". strtotime("now") . ".docx";
//$targetFile = __DIR__ . "/results/{$filename}.{$extension}";

//crear carpeta zip
$directorio = "../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta( $directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi.' - DJ1', $writers);
sleep(1);

echo "1";

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
?>