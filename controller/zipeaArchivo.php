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

    public static function zipearArchivo($directorio,  $nombre_archivo)
    {
        $return = [];
        $status = 0;
        $message = "Zip creado";

        $zip = new ZipArchive();
        $zip->open($directorio . "/" .$nombre_archivo, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directorio),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($directorio) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        $return['data']['file_zip'] = $directorio . "/" .$nombre_archivo;
        $return['data']['numFiles'] = $zip->numFiles;
        $return['status'] = $zip->status;
        $return['message'] = $message;

        // Zip archive will be created only after closing object
        $zip->close();

        /*
        $zip = new ZipArchive();
        $filename = "./test112.zip";

        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            exit("cannot open <$filename>\n");
        }

        $zip->addFromString("testfilephp.txt" . time(), "#1 Esto es una cadena de prueba añadida como  testfilephp.txt.\n");
        $zip->addFromString("testfilephp2.txt" . time(), "#2 Esto es una cadena de prueba añadida como testfilephp2.txt.\n");
        $zip->addFile($thisdir . "/too.php","/testfromfile.php");
        echo "numficheros: " . $zip->numFiles . "\n";
        echo "estado:" . $zip->status . "\n";
        $zip->close();

        $return['data']['archivo'] = $nombre_carpeta . ".zip"; 
        $return['status'] = $status;
        $return['message'] = $message;

        */

        return $return;
    }

}

?>