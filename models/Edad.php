<?php
    class Edad extends Conectar {


        public function update_edad($edad_id, $edad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE confiedad
                SET
                    edad = ?,
                    fech_modi=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$edad);
            $sql->bindValue(2,$edad_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_edad_x_id($edad_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM confiedad WHERE id= ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $edad_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>