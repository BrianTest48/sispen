<?php
    class Cargo extends Conectar {

        public function get_cargos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, nombre, descripcion FROM cargos WHERE est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_id_nombre_cargos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, nombre FROM cargos WHERE est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_cargo_x_id($cargo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM cargos WHERE id= ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cargo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_cargo($cargo_nombre, $cargo_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO cargos (id, nombre, descripcion, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cargo_nombre);
            $sql->bindValue(2,$cargo_descripcion);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_cargo($cargo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE cargos
                SET
                    est=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cargo_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_cargo($cargo_id, $cargo_nombre, $cargo_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE cargos
                SET
                    nombre=?,
                    descripcion=?,
                    fech_modi = now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cargo_nombre);
            $sql->bindValue(2,$cargo_descripcion);
            $sql->bindValue(3,$cargo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
