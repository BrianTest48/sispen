<?php

class exportarWord {

    public static function write($phpWord, $directorio, $filename, $writers)
    {
        $return = [];
        $status = 0;
        $message = "Archivo exportado";
        $result = '';
        // Write documents
        foreach ($writers as $format => $extension) {
            $result = "{$filename}.{$extension}";
            //$result .= date('H:i:s') . " Write to {$format} format";
            if (null !== $extension) 
            {
                //$targetFile = "../files/{$directorio}/{$filename}.{$extension}";
                $targetFile = "{$directorio}/{$filename}.{$extension}";
                //$targetFile = __DIR__ . "/results/{$filename}.{$extension}";
                $phpWord->save($targetFile, $format);
                $message = $message . " " . $result;
            } 
            else 
            {
                $status = -1;
                $message = "problema para crear el archivo";
            }
            //$result .= EOL;
        }
        
        //$result .= getEndingNotes($writers, $filename);
        $return['message'] = $message;
        $return['status'] = $status;
        return $return;
    } 

}

?>