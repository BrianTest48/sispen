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
$nombre_carpeta = $_POST["nombre_carpeta"];
$cargo = $_POST["cargo"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_final = $_POST["fecha_final"];
$fecha_footer = $_POST["fecha_footer"];
$logo = $_POST["logo"];
$firmante = $_POST["firmante"];
$ruc = $_POST["ruc"];
//$zipFile = new \PhpZip\ZipFile();
$section = $phpWord->addSection(array('marginTop'=>2000));
// Crear una imagen como marca de agua
$header = $section->createHeader();
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
$imgpath = '../../assets/img/'.$logo;
$imgoptions = array(
    'width' => 120, // Ancho de la imagen en píxeles
    'height' => 60, // Alto de la imagen en píxeles
    'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
    'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_RIGHT,
    'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
    'marginTop' => 900, // Puedes ajustar la distancia desde la parte superior de la página
    'marginLeft' => 900, // Puedes ajustar la distancia desde el lado derecho de la página
    'wrappingStyle' => 'inline',
);
if($logo == "no-fotos.png" || $logo == ""){

}else {
    $section->addImage($imgpath, $imgoptions);
}
$footer = $section->createFooter();

$phpWord->setDefaultFontName($rutaFuente);
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>32));
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>24));
$phpWord->addFontStyle('font-lg', array('bold'=>false, 'italic'=>false, 'size'=>16));
$phpWord->addFontStyle('font-md', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addFontStyle('font-sm', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addParagraphStyle('text-left', array('align'=>'left', 'spaceAfter'=>100));

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

// $section->addText($nombre_emp,'font-md','indtStyle-left');
$section->addText('RENUNCIA VOLUNTARIA','font-u-md','text-center');
$section->addTextBreak(1);
$section->addText($fecha_footer,'font-md','indtStyle-right');
$section->addText('SEÑORES:','font-md','indtStyle-left');
$section->addText('EMPRESA: '.$nombre_emp ,'font-md','indtStyle-left');





$section->addTextBreak(2);
$section->addText('De mi consideración: ','font-md','indtStyle-left');
$section->addText('          Por intermedio de la presente comunico a ustedes mi renuncia voluntaria, en conformidad del artículo 159 N° 2, del Código del Trabajo y 177, del mismo cuerpo legal, la cual se hará efectiva.','font-md','indtStyle-left');
$section->addText('          Agradeciendo el haberme permitido laborar en vuestra empresa le comunico que por los motivos de mi renuncia son de carácter estrictamente personal.','font-md','indtStyle-left');
$section->addText('          Atentamente','font-md','indtStyle-left');

$section->addTextBreak(3);
$section->addText('____________________','font-md','indtStyle-right');
$section->addText($nombre_afi,'font-md','indtStyle-right');



//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//$targetFile = "../files/". strtotime("now") . ".docx";
//$targetFile = __DIR__ . "/results/{$filename}.{$extension}";

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta( $directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi.'-R10-'.$ruc, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi.'-R10-'.$ruc
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
?>
