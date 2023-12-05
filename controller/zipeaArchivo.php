<?php

class zipeaArchivo {


    public static function crearCarpeta($nombre_carpeta)
    {
        $return = [];
        $status = 0;
        $message = "Zip creado";

        if (is_dir($nombre_carpeta)) {
            $status = 0; // Estado 1 para indicar que la carpeta ya existe
            $message = "Zip creado";
        } else {
            // Intentar crear la carpeta si no existe
            if (!mkdir($nombre_carpeta, 0777, true)) {
                $status = -1; // Estado -1 para indicar un error al crear la carpeta
                $message = "No se pudo crear la carpeta.";
            } else {
                $message = "Carpeta creada correctamente.";
            }
        }

        /*if(!mkdir($nombre_carpeta, 0777, true)) {
            $status = -1;
            $message = "No se puede crear la nueva carpeta para zipear";
        }*/

        $return['data']['archivo'] = $nombre_carpeta; 
        $return['status'] = $status;
        $return['message'] = $message;

        return $return;
    }
    
    public static function crearCarpetaDown($nombre_carpeta, $carpeta_salida)
    {
        $return = [];
        $status = 0;
        $message = "Zip creado";

        $ruta_carpeta = $carpeta_salida . '/' . $nombre_carpeta;

        if (is_dir($ruta_carpeta)) {
            $status = 0; // Estado 1 para indicar que la carpeta ya existe
            $message = "Zip creado";
        } else {
            // Intentar crear la carpeta si no existe
            if (!mkdir($ruta_carpeta, 0777, true)) {
                $status = -1; // Estado -1 para indicar un error al crear la carpeta
                $message = "No se pudo crear la carpeta.";
            } else {
                $message = "Carpeta creada correctamente.";
            }
        }

        $return['data']['archivo'] = $ruta_carpeta; 
        $return['status'] = $status;
        $return['message'] = $message;

        return $return;
    }

    public static function zipearArchivo($directorio_origen, $directorio_salida, $nombre_archivo)
    {
        $return = [];
        $status = 0;
        $message = "Zip creado";

        $ruta_directorio_salida = $directorio_salida . '/' . $nombre_archivo;
        
        $zip = new ZipArchive();
        $zip->open($ruta_directorio_salida, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directorio_origen),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                //$relativePath = substr($filePath, strlen($directorio_origen) + 1);

                // Add current file to archive
               // $zip->addFile($filePath, $relativePath);

                        // Get only the file name
                $relativePath = basename($file);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        $return['data']['file_zip'] = $nombre_archivo;
        $return['data']['numFiles'] = $zip->numFiles;
        $return['status'] = $zip->status;
        $return['message'] = $message;

        // Zip archive will be created only after closing object
        $zip->close();

        return $return;
    }
}

?>
