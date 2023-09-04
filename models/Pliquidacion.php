<?php
    class Pliquidacion extends Conectar {

        public function get_pliquidacion(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM pie_liquidacion WHERE estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /*public function get_id_nombre_cargos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, nombre FROM cargos WHERE est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }*/

        public function get_pliquidacion_x_id($pliquidacion_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM pie_liquidacion WHERE id= ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pliquidacion_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_pliquidacion($pliquidacion_nombre, $pliquidacion_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO pie_liquidacion (id, nombre, descripcion, fech_crea, fech_modi, fech_elim, estado) VALUES (NULL, ?, ?, now(), NULL, NULL , 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pliquidacion_nombre);
            $sql->bindValue(2,$pliquidacion_descripcion);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_pliquidacion($pliquidacion_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE pie_liquidacion
                SET
                    estado=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pliquidacion_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_pliquidacion($pliquidacion_id, $pliquidacion_nombre, $pliquidacion_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE pie_liquidacion
                SET
                    nombre=?,
                    descripcion=?,
                    fech_modi = now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pliquidacion_nombre);
            $sql->bindValue(2,$pliquidacion_descripcion);
            $sql->bindValue(3,$pliquidacion_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
