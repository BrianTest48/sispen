<?php 
    class Salario extends Conectar{
        public function get_salario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM sueldos WHERE est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_salario_x_id($sal_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM sueldos WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sal_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_salario($sal_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE sueldos
                SET
                    est=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sal_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_salario($sal_desde, $sal_hasta, $sal_moneda, $sal_sueldo, $sal_at_ss, $sal_at_pro_des, $sal_at_fondo_juvi, $sal_ap_ss, $sal_ap_fondo_juvi, $sal_ape_fonavi){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO sueldos(id, desde, hasta, unidad_moneda, sueldo_minimo, at_ss, at_pro_desocup, at_fondo_juvi, ap_ss, ap_fondo_juvi, ap_fonavi, fech_crea, fech_modi, fech_elim, est) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sal_desde);
            $sql->bindValue(2,$sal_hasta);
            $sql->bindValue(3,$sal_moneda);
            $sql->bindValue(4,$sal_sueldo);
            $sql->bindValue(5,$sal_at_ss);
            $sql->bindValue(6,$sal_at_pro_des);
            $sql->bindValue(7,$sal_at_fondo_juvi);
            $sql->bindValue(8,$sal_ap_ss);
            $sql->bindValue(9,$sal_ap_fondo_juvi);
            $sql->bindValue(10,$sal_ape_fonavi);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_salario($sal_id, $sal_desde, $sal_hasta, $sal_moneda, $sal_sueldo, $sal_at_ss, $sal_at_pro_des, $sal_at_fondo_juvi, $sal_ap_ss, $sal_ap_fondo_juvi, $sal_ape_fonavi){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE sueldos
            SET
                desde = ?,
                hasta = ?,
                unidad_moneda = ?,
                sueldo_minimo = ?,
                at_ss = ?,
                at_pro_desocup = ?,
                at_fondo_juvi = ?,
                ap_ss = ?,
                ap_fondo_juvi = ?,
                ap_fonavi = ?,
                fech_modi=now()
            WHERE
                id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sal_desde);
            $sql->bindValue(2,$sal_hasta);
            $sql->bindValue(3,$sal_moneda);
            $sql->bindValue(4,$sal_sueldo);
            $sql->bindValue(5,$sal_at_ss);
            $sql->bindValue(6,$sal_at_pro_des);
            $sql->bindValue(7,$sal_at_fondo_juvi);
            $sql->bindValue(8,$sal_ap_ss);
            $sql->bindValue(9,$sal_ap_fondo_juvi);
            $sql->bindValue(10,$sal_ape_fonavi);
            $sql->bindValue(11,$sal_id);
            $sql->execute();
              
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  
        }
    }
?>