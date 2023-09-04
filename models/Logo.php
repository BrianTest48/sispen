<?php
    class Logo extends Conectar {

        public function get_logos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, nombre, imagen, est FROM logos WHERE est = 'H';";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_logo_x_id($logo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM logos WHERE id= ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $logo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_logo($logo_nombre, $logo_imagen, $logo_estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO logos (id, nombre, imagen, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, ?, now(), NULL, NULL, ?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$logo_nombre);
            $sql->bindValue(2,$logo_imagen);
            $sql->bindValue(3,$logo_estado);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_logo($logo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE logos
                SET
                    est=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$logo_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_logo($logo_id, $logo_nombre, $logo_imagen, $logo_estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE logos
                SET
                    nombre=?,
                    imagen=?,
                    est=?,
                    fech_modi = now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$logo_nombre);
            $sql->bindValue(2,$logo_imagen);
            $sql->bindValue(3,$logo_estado);
            $sql->bindValue(4,$logo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_logos_nombre(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, imagen, nombre FROM logos WHERE est = 'H';";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>
