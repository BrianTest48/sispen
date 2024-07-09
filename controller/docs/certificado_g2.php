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
$num_emp = $_POST['num_emp'];

// Variable para controlar si se muestra la marca de agua
$mostrarMarcaAgua = false;

// Verificar si se ha enviado una imagen en la solicitud POST y si no está vacía
if (isset($_POST["nombre_fondo"]) && !empty($_POST["nombre_fondo"])) {
    // Ruta de la imagen de la marca de agua
    $rutaImagen = '../../assets/img/' . $_POST["nombre_fondo"];

    // Verificar si la imagen existe
    if (file_exists($rutaImagen)) {
        // Establecer la variable $imagenMarcaAgua con la ruta de la imagen
        $mostrarMarcaAgua = true;
    }
}

$section = $phpWord->addSection(array('marginTop'=>2000));


/**START FONDO */
// Crear una imagen como marca de agua
$header = $section->createHeader();

if($mostrarMarcaAgua){

    // Ruta de la imagen de la marca de agua
    $imagenMarcaAgua = '../../assets/img/'.$_POST["nombre_fondo"];

    // Obtener dimensiones originales de la imagen
    list($anchoOriginal, $altoOriginal) = getimagesize($imagenMarcaAgua);

    // Obtener dimensiones de la página actual del documento
    $anchoPagina = $section->getPageWidth();
    $altoPagina = $section->getPageHeight();

    // Aplicar un factor de reducción adicional
    $factorReduccion = 0.5; // Puedes ajustar este valor según sea necesario

    // Calcular nuevas dimensiones de la imagen
    $nuevoAncho = $anchoOriginal * $factorReduccion;
    $nuevoAlto = $altoOriginal * $factorReduccion;

    // Opciones de la imagen de la marca de agua
    $opcionesImagen = array(
        'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER,
        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'posVertical' => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_CENTER,
        'posVerticalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'marginTop' => 0, // Ajusta según sea necesario
        'width' => $nuevoAncho,
        'height' => $nuevoAlto,
    );

    // Agregar la imagen de la marca de agua al encabezado
    $header->addImage($imagenMarcaAgua, $opcionesImagen);
}

/*END FONDO */
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
$section->addText($nombre_emp,'font-lg','text-left');
$section->addText($ruc,'font-sm','text-left');


$section->addTextBreak(4);
$section->addText('CERTIFICADO DE TRABAJO','font-lg-negrita','indtStyle-left');

$section->addTextBreak(1);
$section->addText('EL FUNCIONARIO DE LA EMPRESA DEL RUBRO CERTIFICA : ','font-md','indtStyle-left');
$section->addText('               A Don '.$nombre_afi.' al haber desempeñado sus labores durante el periodo desde el '.$fecha_inicio.' hasta '.$fecha_final.' fecha que se retira voluntariamente por razones personales.','font-md','indtStyle-left');
$section->addText('               Se hace incapié que Don '.$nombre_afi.' fue un personal diligente y colaborador, siempre dispuesto a colaborar en la medida de sus posibilidades, por lo que se cumple con emitirle este certificado para los fines que le convenga.','font-md','indtStyle-left');

$section->addTextBreak(3);
$section->addText($fecha_footer,'font-md','indtStyle-left');
$section->addTextBreak(3);
$section->addText('...........................................','font-md','text-center');
$section->addText($firmante,'font-md','text-center');


//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//$targetFile = "../files/". strtotime("now") . ".docx";
//$targetFile = __DIR__ . "/results/{$filename}.{$extension}";

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta( $directorio . $nombre_carpeta);

//Variable para nombre del archivo.
$nombre_archivo = 'Certificado-'.$nombre_emp.'- (Empresa '.$num_emp.')';

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_archivo, $writers);
sleep(1);


// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_archivo
);

// Convertir el array asociativo a JSON
echo json_encode($responseData);

?>