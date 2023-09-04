<?php
    class Pension extends Conectar{
        public function pension_aleatorio($f_nacimiento, $cant_emp, $cant_an){
            $conectar = parent::conexion();
            parent::set_names();
            /*$sql = "SELECT id , empleador , DATE_FORMAT(f_inic_act, '%e-%c-%Y') as f_inic_act, DATE_FORMAT(f_baja_act, '%e-%c-%Y') as f_baja_act FROM empresas 
            WHERE f_inic_act > DATE_ADD(?, interval 18 year) AND est = 1
            ORDER BY rand() 
            LIMIT 3;";*/
            /*$sql="SELECT id , empleador , DATE_FORMAT(f_inic_act, '%e-%c-%Y') as f_inic_act, DATE_FORMAT(f_baja_act, '%e-%c-%Y') as f_baja_act FROM empresas 
            WHERE f_inic_act > DATE_ADD( ?, INTERVAL 18 YEAR)  AND f_inic_act < '1994-12-31'
            ORDER BY rand() 
            LIMIT ? ;";*/
            $sql= "CALL mostrar_empresas (? , ?, ?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$f_nacimiento);
            $sql->bindValue(2,$cant_an , PDO::PARAM_INT);
            $sql->bindValue(3,$cant_emp, PDO::PARAM_INT);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_afiliado($tipo_doc, $num_doc, $nom, $ape, $f_nacimiento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO afiliados(id, tipo_doc, num_doc, nombres, ap_pa, fech_nac, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, ?, ?, ?, ?, now(),NULL, NULL , 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipo_doc);
            $sql->bindValue(2,$num_doc);
            $sql->bindValue(3,$nom);
            $sql->bindValue(4,$ape);
            $sql->bindValue(5,$f_nacimiento);
            $sql->execute();
            //return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_afiliado_x_tipo($tipo_doc, $num_doc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "SELECT id, tipo_doc, num_doc, nombres, ap_pa, fech_nac FROM afiliados WHERE tipo_doc = ? AND num_doc = ? AND est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipo_doc);
            $sql->bindValue(2,$num_doc);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function pension_aleatorio_empresa($f_inicio, $f_fin){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="CALL obtenerListadoEmpresas(?, ?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$f_inicio);
            $sql->bindValue(2,$f_fin);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function pension_empresa_dpto($f_inicio, $f_fin, $emp){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="CALL obtenerListadoEmpresasRazon(?, ?, ?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$f_inicio);
            $sql->bindValue(2,$f_fin);
            $sql->bindValue(3,$emp);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_lista_rptempresas($nroEmpresas, $f_fnac){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="CALL USP_RptListadoEmpresas(?, ?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$f_fnac);
            $sql->bindValue(2,$nroEmpresas);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_sueldo_mes($fecha){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM sueldos 
                    WHERE ? BETWEEN desde AND hasta 
                    LIMIT 1;
                    ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fecha);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>