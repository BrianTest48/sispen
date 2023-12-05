<?php

require_once '../../vendor/assets/PHPWord/vendor/autoload.php';
require_once '../exportarWord.php';
require_once '../zipeaArchivo.php';
require_once("../../util/cantidad_en_letras.php");
//require_once '../vendor/assets/PHPWord/lib/PhpOffice/PhpWord/PHPZip/src/ZipFile.php';

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\TablePosition;
use PhpOffice\PhpWord\SimpleType\Jc;

$phpWord = new \PhpOffice\PhpWord\PhpWord();
$letras = new EnLetras();
$rutaFuente = '../../assets/fonts/typewriter/JMH Typewriter-Black.ttf';
$nombre_emp = $_POST["empresa"];
$nombre_afi = $_POST["afiliado"];
$nombre_carpeta = $_POST["nombre_carpeta"];
$cargo = $_POST["cargo"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_final = $_POST["fecha_final"];
$fecha_inicio_num = $_POST["fecha_inicio_num"];
$fecha_final_num = $_POST["fecha_final_num"];
$fecha_footer = $_POST["fecha_footer"];
$dias_lq = $_POST["dias_liqui"];
$meses_lq = $_POST["meses_liqui"];
$anios_lq = $_POST["anios_liqui"];
$sueldo = $_POST["sueldo"];
$moneda = $_POST["moneda"];
$retiro = $_POST["motivo"];
$anio = $_POST["anio_final"];
$cuerpo = $_POST["cuerpo"];
$ruc = $_POST["ruc"];

//ADICIONALES
$adelanto = number_format($_POST["ADELANTO"], 2, '.', '');
$vacaciones = number_format($_POST["VACACIONES"], 2, '.', '');
$gratificaciones = number_format($_POST["GRATIFICACIONES"], 2, '.', '');
$reintegro = number_format($_POST["REINTEGRO"], 2, '.', '');
$incentivo = number_format($_POST["INCENTIVO"], 2, '.', '');
$bonif = number_format($_POST["BONIFICACION"], 2, '.', '');
$bonif_extra = number_format($_POST["bonif_ext"], 2, '.', '');
$bonif_grac = number_format($_POST["bonif_gra"], 2, '.', '');
$bonif_meta = number_format($_POST["bonif_met"], 2, '.', '');
$bonif_fest = number_format($_POST["bonif_dias"], 2, '.', '');
$meses_lq_nv;
$version3 = 0;

$sueldo = number_format($sueldo, 2, '.', '');

if($anio >= 1960 && $anio <= 1979){

    if($dias_lq > 0){
        $meses_lq_nv = $meses_lq + 1;
    }else {
        $meses_lq_nv = $meses_lq;
    }
    $dias_sueldo = 0;
    $anios_sueldo = number_format(($sueldo * $anios_lq), 2, '.', '');
    $meses_sueldo = number_format((($sueldo/12)* $meses_lq_nv), 2, '.', '');
    $subtotal = number_format(($anios_sueldo + $meses_sueldo), 2, '.', '');
    
}

if($anio >= 1980 && $anio <= 1999){
    $meses_lq_nv = $meses_lq;
    $anios_sueldo = number_format(($sueldo * $anios_lq), 2, '.', '');
    $meses_sueldo = number_format((($sueldo/12)* $meses_lq_nv), 2, '.', '');
    $dias_sueldo = number_format(((($sueldo/12)/30)* $dias_lq), 2, '.', '');
    $subtotal = number_format(($anios_sueldo + $meses_sueldo + $dias_sueldo), 2, '.', '');
}




$total_cp = $adelanto + $vacaciones + $gratificaciones + $reintegro + $incentivo + $bonif + $bonif_extra + $bonif_grac + $bonif_meta  + $bonif_fest;

$m_total = $anios_sueldo + $meses_sueldo + $dias_sueldo + $adelanto + $vacaciones + $gratificaciones + $reintegro + $incentivo + $bonif + $bonif_extra + $bonif_grac + $bonif_meta  + $bonif_fest;
$montototal = number_format($m_total, 2, '.', '');
$total_concepto = number_format($total_cp, 2, '.', '');

$monto_letra= $letras->ValorEnLetras($montototal,"");

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

$phpWord->setDefaultFontName($rutaFuente);
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>32));
$phpWord->addFontStyle('font-xxl', array('bold'=>false, 'italic'=>false, 'size'=>24));
$phpWord->addFontStyle('font-lg', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addFontStyle('font-md', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addFontStyle('font-sm', array('bold'=>false, 'italic'=>false, 'size'=>8));
$phpWord->addParagraphStyle('text-left', array('align'=>'left', 'spaceAfter'=>100));

$phpWord->addFontStyle('font-u-lg', array('bold'=>false, 'italic'=>false, 'size'=>16, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-u-md', array('bold'=>false, 'italic'=>false, 'size'=>12, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));

$phpWord->addParagraphStyle('text-center', array('align'=>'center', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('text-right', array('align'=>'right', 'spaceAfter'=>100));
$phpWord->addParagraphStyle('pnStyle', array('align'=>'left','indentation' => array('left' => 250), 'spacing'=>150));
//Justificar parrafo
$phpWord->addParagraphStyle('text-just', array('alignment' => Jc::BOTH));

//Me
$phpWord->addFontStyle('font-lg-negrita', array('bold'=>true, 'italic'=>false, 'size'=>12, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$phpWord->addFontStyle('font-md-justificado', array('bold'=>false, 'italic'=>false, 'size'=>12));
$phpWord->addParagraphStyle('sangria', array('indentation' => array('left' => 250), 'spacing'=>150));
$phpWord->addParagraphStyle('text-justify', array('align'=>'both'));
$phpWord->addFontStyle('font-md-negrita', array('bold'=>true, 'italic'=>false, 'size'=>8));

//$section->addText('B.S.013-72-','font-sm','text-right');
//$section->addText('RAZON SOCIAL: DE OSMA ELIAS FELIPE','font-u-lg','text-center');
$section->addText($nombre_emp,'font-lg','text-left');

//$section->addTextBreak(1);
$section->addText('LIQUIDACION DE BENEFICIOS SOCIALES','font-lg-negrita','text-center');


$tableStyleName = 'tabla_1';
$tableStyle = ['borderTopSize' => 12, 
                'borderBottomSize' => 12, 
                'borderColor' => '000000', 
                'cellMargin' => 5, 
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
                'cellSpacing' => 0];
//$tableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
$tableCellStyle = ['valign' => 'center'];
$tableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
$tableFontStyle = ['bold' => true];
//$phpWord->addTableStyle($tableStyleName, $tableStyle, $tableFirstRowStyle);
$phpWord->addTableStyle($tableStyleName, $tableStyle);
$table = $section->addTable($tableStyleName);
//$table = $section->addTable();
$table->addRow();
$table->addCell(4500)->addText("DATOS DEL TRABAJADOR",'font-md');
$table->addCell(4500)->addText($nombre_afi,'font-md');
$table->addRow();
$table->addCell(4500)->addText("FECHA DE INGRESO",'font-md');
$table->addCell(4500)->addText($fecha_inicio,'font-md');
$table->addRow();
$table->addCell(4500)->addText("FECHA DE CESE",'font-md');
$table->addCell(4500)->addText($fecha_final,'font-md');
$table->addRow();
$table->addCell(4500)->addText("CARGO DESEMPEÑADO",'font-md');
$table->addCell(4500)->addText($cargo,'font-md');
$table->addRow();
$table->addCell(4500)->addText("TIEMPO DE SERVICIOS",'font-md');
$table->addCell(4500)->addText($anios_lq." AÑOS ".$meses_lq." MESES ".$dias_lq." DIAS",'font-md');
$table->addRow();
$table->addCell(4500)->addText("MOTIVO DE RENUNCIA",'font-md');
$table->addCell(4500)->addText($retiro,'font-md');

if($anio >= 1960 && $anio<= 1979){
    if($cuerpo == 1){
        $section->addText('CALCULO POR TIEMPO DE SERVICIOS','font-md-negrita','text-center');
        $table_1 = $section->addTable($tableStyleName);
        $table_1->addRow();
        $table_1->addCell(4000)->addText($fecha_inicio_num." AL ".$fecha_final_num,'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($anios_lq." Años y ".$meses_lq_nv." Meses",'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($anios_lq." Años x ".$moneda." ".$sueldo,'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$anios_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($meses_lq_nv." Meses x ".$moneda." ".$sueldo."/12",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$meses_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText("SUB- TOTAL:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$subtotal,'font-md','text-right');
    }
    if($cuerpo == 2){
        $section->addText('RESUMEN','font-md-negrita','text-center');
        $table_1 = $section->addTable($tableStyleName);
        $table_1->addRow();
        $table_1->addCell(4000)->addText($fecha_inicio_num." HASTA ".$fecha_final_num,'font-md');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(4000)->addText('ULTIMO SUELDO '.$moneda.' '.$sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($anios_lq." Años y ".$meses_lq_nv." Meses",'font-md');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(4000)->addText('REDONDEO','font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($moneda." ".$sueldo.' x '.$anios_lq." Años",'font-md');
        $table_1->addCell(1000)->addText("",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$anios_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($moneda." ".$sueldo."/12 x ".$meses_lq_nv." Meses",'font-md');
        $table_1->addCell(1000)->addText("",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$meses_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText("SUB- TOTAL:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$subtotal,'font-md','text-right');
    }
    if($cuerpo == 3){
        $section->addText('CALCULO DE BENEFICIOS SOCIALES','font-md-negrita','text-center');
        $table_1 = $section->addTable($tableStyleName);
        $table_1->addRow();
        $table_1->addCell(7000)->addText($fecha_inicio." -".$fecha_final,'font-md');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(1000)->addText(' ','font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($anios_lq." Años y ".$meses_lq_nv." Meses, REDONDEO",'font-md');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(4000)->addText(' ','font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($moneda." ".$sueldo.' x '.$anios_lq." Años",'font-md');
        $table_1->addCell(1000)->addText("",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$anios_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($moneda." ".$sueldo."/12 x ".$meses_lq_nv." Meses",'font-md');
        $table_1->addCell(1000)->addText("",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$meses_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText("SUB- TOTAL:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$subtotal,'font-md','text-right');
    }
}

if($anio >= 1980 && $anio <= 1999){
    if($cuerpo == 1){
        $section->addText('COMPENSACION POR TIEMPO DE SERVICIOS','font-md-negrita','text-center');
        $table_0 = $section->addTable($tableStyleName);
        $table_0->addRow();
        $table_0->addCell(4000)->addText('REMUNERACION MENSUAL','font-md');
        $table_0->addCell(1000)->addText(" ",'font-md','text-center');
        $table_0->addCell(4000)->addText($moneda.' '.$sueldo,'font-md','text-right');
        $table_0->addRow();
        $table_0->addCell(4000)->addText('VACACIONES TRUNCAS','font-md');
        $table_0->addCell(1000)->addText(' ','font-md','text-center');
        $table_0->addCell(4000)->addText('CANCELADO','font-md','text-right');
        $table_0->addRow();
        $table_0->addCell(4000)->addText('GRATIFICACIONES TRUNCAS','font-md');
        $table_0->addCell(1000)->addText(' ','font-md','text-center');
        $table_0->addCell(4000)->addText('CANCELADO','font-md','text-right');

        $section->addText('CALCULO DE LIQUIDACION','font-md-negrita','text-center');
        $table_1 = $section->addTable($tableStyleName);
        $table_1->addRow();
        $table_1->addCell(4000)->addText($anios_lq." Años x ".$moneda." ".$sueldo,'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$anios_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($meses_lq_nv." Meses x ".$moneda." ".$sueldo."/12",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$meses_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText($dias_lq." Días x ".$moneda." ".$sueldo."/12/30",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$dias_sueldo,'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(4000)->addText("SUB- TOTAL:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$subtotal,'font-md','text-right');
            
    }

    if($cuerpo == 2){
        $section->addText('LIQUIDACION','font-md-negrita','text-center');
        $table_1 = $section->addTable($tableStyleName);
        $table_1->addRow();
        $table_1->addCell(4000)->addText($anios_lq." Años, ".$meses_lq_nv." Meses y ".$dias_lq.' Dias x '.$moneda.' '.$sueldo,'font-md');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$subtotal,'font-md','text-right');
    }
    if($cuerpo == 3){

        //darle un valor a v3
        $version3 = 1;

        $section->addText('CALCULO DE LIQUIDACION DE BENEFICIOS SOCIALES','font-md-negrita','text-center');
        $table_1 = $section->addTable($tableStyleName);
        $table_1->addRow();
        $table_1->addCell(3000)->addText('CONTABILIZACIÓN','font-md','text-left');
        $table_1->addCell(3000)->addText(' ','font-md','text-left');
        $table_1->addCell(3000)->addText(' ','font-md','text-left');
        $table_1->addRow();
        $table_1->addCell(3000)->addText($anios_lq." Años x ".$moneda." ".$sueldo,'font-md');
        $table_1->addCell(3000)->addText($moneda." ".$anios_sueldo,'font-md','text-right');
        $table_1->addCell(3000)->addText("",'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(3000)->addText($meses_lq_nv." Meses x ".$moneda." ".$sueldo."/12",'font-md');
        $table_1->addCell(3000)->addText($moneda." ".$meses_sueldo,'font-md','text-right');
        $table_1->addCell(3000)->addText("",'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(3000)->addText($dias_lq." Días x ".$moneda." ".$sueldo."/12/30",'font-md');
        $table_1->addCell(3000)->addText($moneda." ".$dias_sueldo,'font-md','text-right');
        $table_1->addCell(3000)->addText("",'font-md','text-right');
        $table_1->addRow();
        $table_1->addCell(3000)->addText(" ",'font-md');
        $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        $table_1->addCell(3000)->addText($moneda." ".$subtotal,'font-md','text-right');

        if($adelanto != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("ADELANTO:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$adelanto,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($vacaciones != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("VACACIONES:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$vacaciones,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($gratificaciones != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("GRATIFICACIONES:",'font-md');
            $table_1->addCell(4000)->addText($moneda." ".$gratificaciones,'font-md','text-right');
            $table_1->addCell(4000)->addText(" ",'font-md','text-center');
        }
        if($reintegro != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("REINTEGRO:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$reintegro,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($incentivo != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("INCENTIVO:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$incentivo,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($bonif != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("BONIFICACION:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$bonif,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($bonif_extra != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("BON. EXTRAORDINARIA:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$bonif_extra,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($bonif_grac != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("BON. GRACIOSA:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$bonif_grac,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($bonif_meta != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("BON. POR CUMPLIENTO DE META:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$bonif_meta,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }
        if($bonif_fest != "0"){
            $table_1->addRow();
            $table_1->addCell(3000)->addText("BON. POR DIAS FESTIVOS:",'font-md');
            $table_1->addCell(3000)->addText($moneda." ".$bonif_fest,'font-md','text-right');
            $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        }

        $table_1->addRow();
        $table_1->addCell(3000)->addText(" ",'font-md');
        $table_1->addCell(3000)->addText(" ",'font-md','text-center');
        $table_1->addCell(3000)->addText($moneda." ".$total_concepto,'font-md','text-right');

    }
}


if($version3 == 0){
    if($adelanto != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("ADELANTO:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$adelanto,'font-md','text-right');
    }
    if($vacaciones != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("VACACIONES:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$vacaciones,'font-md','text-right');
    }
    if($gratificaciones != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("GRATIFICACIONES:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$gratificaciones,'font-md','text-right');
    }
    if($reintegro != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("REINTEGRO:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$reintegro,'font-md','text-right');
    }
    if($incentivo != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("INCENTIVO:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$incentivo,'font-md','text-right');
    }
    if($bonif != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("BONIFICACION:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$bonif,'font-md','text-right');
    }
    if($bonif_extra != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("BON. EXTRAORDINARIA:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$bonif_extra,'font-md','text-right');
    }
    if($bonif_grac != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("BON. GRACIOSA:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$bonif_grac,'font-md','text-right');
    }
    if($bonif_meta != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("BON. POR CUMPLIENTO DE META:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$bonif_meta,'font-md','text-right');
    }
    if($bonif_fest != "0"){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("BON. POR DIAS FESTIVOS:",'font-md');
        $table_1->addCell(1000)->addText("=",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$bonif_fest,'font-md','text-right');
    }
}


if($anio >= 1960 && $anio<= 1979){
    $table_1->addRow();
    $table_1->addCell(4000)->addText("NETO A PAGAR:",'font-md-negrita');
    $table_1->addCell(1000)->addText("=",'font-md','text-center');
    $table_1->addCell(4000)->addText($moneda." ".$montototal,'font-md-negrita','text-right');
}

if($anio >= 1980 && $anio<= 1999){
    if($cuerpo == 1){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("A DEPOSITAR:",'font-md-negrita');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$montototal,'font-md-negrita','text-right');
    }
    if($cuerpo == 2){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("TOTAL A PAGAR:",'font-md-negrita');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$montototal,'font-md-negrita','text-right');
    }
    if($cuerpo == 3){
        $table_1->addRow();
        $table_1->addCell(4000)->addText("TOTAL A COBRAR:",'font-md-negrita');
        $table_1->addCell(1000)->addText(" ",'font-md','text-center');
        $table_1->addCell(4000)->addText($moneda." ".$montototal,'font-md-negrita','text-right');
    }
}


$section->addTextBreak(1);

$section->addText('SON: '.$monto_letra.' SOLES ORO','font-sm','text-just');
$section->addText('Dejo expresa constancia que el monto indicado en la presente LIQUIDACION, corresponde al total de los BENEFICIOS SOCIALES, que me correspondan de acuerdo a ley, no teniendo reclamo alguno en lo sucesivo que efectuar por este concepto en contra de la Empresa.','font-sm','text-just');
$section->addTextBreak(1);
$section->addText($fecha_footer,'font-sm','text-right');

$section->addText('..........................','font-sm','text-center');
$section->addText($nombre_afi,'font-sm','text-center');

//$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');
$writers = array('Word2007' => 'docx');

//$targetFile = "../files/". strtotime("now") . ".docx";
//$targetFile = __DIR__ . "/results/{$filename}.{$extension}";

//crear carpeta zip
$directorio = "../../files/";
//$nombre_carpeta = "zip_" . strtotime("now");


$creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);

exportarWord::write($phpWord, $directorio . $nombre_carpeta, $nombre_afi.'-LQ2-'.$ruc, $writers);
sleep(1);

//echo "1";

// Datos que deseas enviar como JSON (número y texto)
$responseData = array(
    "estado" => 1,
    "archivo" => $nombre_afi.'-LQ2-'.$ruc
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