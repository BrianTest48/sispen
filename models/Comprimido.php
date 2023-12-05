<?php
    class Comprimido extends Conectar {

        public function get_comprimido(){
            /*$conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, nombre, descripcion FROM cargos WHERE est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);*/

            $rutaCarpeta = '../files/zips/'; // Reemplaza con la ruta de tu carpeta

            // Obtener la lista de archivos y directorios en la carpeta
            $archivos = scandir($rutaCarpeta);

            // Eliminar las entradas "." y ".." del array (directorios de referencia)
            $archivos = array_diff($archivos, array('.', '..'));

            // Convertir el array en un array indexado numéricamente
            $archivos = array_values($archivos);
            
            return $archivos;
        }

    }
?>
