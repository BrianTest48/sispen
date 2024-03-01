<?php 
    class Direccion extends Conectar{
        public function get_direccion(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM direccion";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_direccion_x_ruc($ruc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM direccion WHERE ruc = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ruc);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
?>