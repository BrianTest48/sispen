<?php
    class Fondo extends Conectar {

        public function get_fondos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, nombre, imagen, estado FROM fondos WHERE estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_fondo_x_id($fondo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM fondos WHERE id= ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fondo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_fondo($fondo_nombre, $fondo_imagen){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO fondos (id, nombre, imagen, fech_crea, fech_modi, fech_elim, estado) VALUES (NULL, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fondo_nombre);
            $sql->bindValue(2,$fondo_imagen);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_fondo($fondo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE fondos
                SET
                    estado = 0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fondo_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_fondo($fondo_id, $fondo_nombre, $fondo_imagen){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE fondos
                SET
                    nombre=?,
                    imagen=?,
                    fech_modi = now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fondo_nombre);
            $sql->bindValue(2,$fondo_imagen);
            $sql->bindValue(3,$fondo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_fondos_nombre(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, imagen, nombre FROM fondos WHERE estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>
