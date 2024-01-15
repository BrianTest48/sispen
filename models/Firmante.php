<?php
    class Firmante extends Conectar{
        public function get_firmante(){
            $conectar= parent::conexion();
            parent::set_names();
           $sql=  "SELECT tf.id, tf.ruc, tf.firma_nombre, tf.dni, tc.nombre, tf.fech_inicio, tf.fech_fin, tf.estado, tf.fecha_f FROM firmantes as tf 
                    LEFT JOIN cargos as tc 
                    ON tf.id_cargo=tc.id 
                    WHERE tf.est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_firmante_x_id($firm_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM firmantes WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$firm_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_firmante_x_dni_ruc($dni , $ruc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM firmantes WHERE dni = ? AND ruc = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dni);
            $sql->bindValue(2,$ruc);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_firmante_x_ruc( $ruc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM firmantes  AND ruc = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ruc);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_firmante($firm_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE firmantes
                SET
                    est=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$firm_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_firmante($firm_ruc, $firm_nom, $firm_dni, $id_cargo, $firm_fech_inicio, $firm_fech_fin,  $firm_estado, $firm_fech_falle){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO firmantes (id, ruc, firma_nombre, dni, id_cargo, fech_inicio , fech_fin, estado, fecha_f, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$firm_ruc);
            $sql->bindValue(2,$firm_nom);
            $sql->bindValue(3,$firm_dni);
            $sql->bindValue(4,$id_cargo);
            $sql->bindValue(5,$firm_fech_inicio);
            $sql->bindValue(6,$firm_fech_fin);
            $sql->bindValue(7,$firm_estado);
            $sql->bindValue(8,$firm_fech_falle);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }


        public function update_firmante($firm_ruc, $firm_id, $firm_nom, $firm_dni, $id_cargo, $firm_fech_inicio, $firm_fech_fin,  $firm_estado, $firm_fech_falle){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE firmantes
                SET
                    ruc = ?,
                    firma_nombre=?,
                    dni =?,
                    id_cargo=?,
                    fech_inicio=?,
                    fech_fin=?,
                    estado=?,
                    fecha_f=?,
                    fech_modi=now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$firm_ruc);
            $sql->bindValue(2,$firm_nom);
            $sql->bindValue(3,$firm_dni);
            $sql->bindValue(4,$id_cargo);
            $sql->bindValue(5,$firm_fech_inicio);
            $sql->bindValue(6,$firm_fech_fin);
            $sql->bindValue(7,$firm_estado);
            $sql->bindValue(8,$firm_fech_falle);
            $sql->bindValue(9,$firm_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_firmante_x_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "SELECT tc.nombre FROM firmantes tp 
                    INNER JOIN cargos tc 
                    ON tp.cat_id = tc.id 
                    WHERE tp.est = 1 
                    GROUP BY tc.nombre";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_firmante_empresa($ruc){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT id,  firma_nombre, firma_ape FROM firmantes WHERE est = 1;";
            $sql = "SELECT tf.id, tf.ruc, tf.dni,tf.firma_nombre, tc.nombre, DATE_FORMAT(tf.fech_inicio, '%e-%c-%Y') as fech_inicio, DATE_FORMAT( tf.fech_fin, '%e-%c-%Y') as fech_fin,  YEAR(tf.fech_inicio) as anio_inicio,  YEAR(tf.fech_fin) as anio_fin, tf.estado, DATE_FORMAT(tf.fecha_f, '%e-%c-%Y') AS fecha_f FROM firmantes as tf 
                    LEFT JOIN cargos as tc 
                    ON tf.id_cargo=tc.id 
                    WHERE tf.est = 1 AND tf.ruc = ? ;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ruc);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>
