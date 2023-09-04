<?php
    class Motivo extends Conectar {

        public function get_motivos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, descripcion FROM motivo_cese WHERE estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

       
        public function get_motivo_x_id($motivo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM motivo_cese WHERE id= ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $motivo_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_motivo($motivo_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO motivo_cese(id, descripcion, fech_crea, fech_modi, fech_elim, estado) VALUES (NULL, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$motivo_descripcion);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_motivo($motivo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE motivo_cese
                SET
                    estado=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$motivo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_motivo($motivo_id, $motivo_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE motivo_cese
                SET
                    descripcion=?,
                    fech_modi = now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$motivo_descripcion);
            $sql->bindValue(2,$motivo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
