<?php 
    class Empresa extends Conectar{
        public function get_empresa(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM empresas WHERE est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_empresa_utilizadas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM empresas WHERE est = 1 AND busqueda = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_empresa_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM empresas WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_empresa($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE empresas
                SET
                    est=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_empresa($emp_tipo, $emp_ruc, $emp_rzsocial, $emp_dir, $emp_dpto, $emp_prov, $emp_dist, $emp_f_inic_act, $emp_f_baja_act,$emp_rep_leg, $emp_dni_a, $emp_f_inic_rep_leg, $emp_rep_legal_2, $emp_dni_b, $emp_f_inic_rep_leg_2 , $emp_estado, $emp_condicion ){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO empresas(id, ind,tipo_emp, ruc, empleador, direccion, dpto, prov, dist, f_inic_act, f_baja_act, rep_legal, dni_a, f_inicio_a, otro_representante, dni_b, f_inicio_b, imprimir, estado_emp, habido_emp, fech_crea, fech_modi, fech_elim, est) 
                    VALUES (NULL,'R',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?, ?,'IMPRIMIR',now(),NULL,NULL,1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$emp_tipo);
            $sql->bindValue(2,$emp_ruc);
            $sql->bindValue(3,$emp_rzsocial);
            $sql->bindValue(4,$emp_dir);
            $sql->bindValue(5,$emp_dpto);
            $sql->bindValue(6,$emp_prov);
            $sql->bindValue(7,$emp_dist);
            $sql->bindValue(8,$emp_f_inic_act);
            $sql->bindValue(9,$emp_f_baja_act);
            $sql->bindValue(10,$emp_rep_leg);
            $sql->bindValue(11,$emp_dni_a);
            $sql->bindValue(12,$emp_f_inic_rep_leg);
            $sql->bindValue(13,$emp_rep_legal_2);
            $sql->bindValue(14,$emp_dni_b);
            $sql->bindValue(15,$emp_f_inic_rep_leg_2);
            $sql->bindValue(16,$emp_estado);
            $sql->bindValue(17,$emp_condicion);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_empresa($emp_id, $emp_tipo,$emp_ruc, $emp_rzsocial, $emp_dir, $emp_dpto, $emp_prov, $emp_dist, $emp_f_inic_act, $emp_f_baja_act, $emp_rep_leg, $emp_dni_a, $emp_f_inic_rep_leg, $emp_rep_legal_2, $emp_dni_b, $emp_f_inic_rep_leg_2, $emp_estado, $emp_condicion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE empresas
                SET
                    tipo_emp=?,
                    ruc=?,
                    empleador=?,
                    direccion=?,
                    dpto=?,
                    prov=?,
                    dist=?,
                    f_inic_act=?,
                    f_baja_act=?,
                    rep_legal=?,
                    dni_a=?,
                    f_inicio_a=?,
                    otro_representante=?,
                    dni_b=?,
                    f_inicio_b=?,
                    estado_emp = ?,
                    habido_emp = ?,
                    fech_modi=now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$emp_tipo);
            $sql->bindValue(2,$emp_ruc);
            $sql->bindValue(3,$emp_rzsocial);
            $sql->bindValue(4,$emp_dir);
            $sql->bindValue(5,$emp_dpto);
            $sql->bindValue(6,$emp_prov);
            $sql->bindValue(7,$emp_dist);
            $sql->bindValue(8,$emp_f_inic_act);
            $sql->bindValue(9,$emp_f_baja_act);
            $sql->bindValue(10,$emp_rep_leg);
            $sql->bindValue(11,$emp_dni_a);
            $sql->bindValue(12,$emp_f_inic_rep_leg);
            $sql->bindValue(13,$emp_rep_legal_2);
            $sql->bindValue(14,$emp_dni_b);
            $sql->bindValue(15,$emp_f_inic_rep_leg_2);
            $sql->bindValue(16,$emp_estado);
            $sql->bindValue(17,$emp_condicion);
            $sql->bindValue(18,$emp_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_empresa_api($emp_ruc, $emp_rzsocial, $emp_dir, $emp_dpto, $emp_prov, $emp_dist, $emp_f_inic_act, $emp_f_baja_act, $estado, $condicion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE empresas
                SET
                    empleador=?,
                    direccion=?,
                    dpto=?,
                    prov=?,
                    dist=?,
                    f_inic_act=?,
                    f_baja_act=?,
                    estado_emp = ?,
                    habido_emp = ?
                WHERE
                    ruc = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$emp_rzsocial);
            $sql->bindValue(2,$emp_dir);
            $sql->bindValue(3,$emp_dpto);
            $sql->bindValue(4,$emp_prov);
            $sql->bindValue(5,$emp_dist);
            $sql->bindValue(6,$emp_f_inic_act);
            $sql->bindValue(7,$emp_f_baja_act);
            $sql->bindValue(8,$estado);
            $sql->bindValue(9,$condicion);
            $sql->bindValue(10,$emp_ruc);

            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_empresa_usada($emp_ruc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE empresas
                SET
                    busqueda = 1,
                    fecha_busqueda = now(),
                    fech_modi=now()
                WHERE
                    ruc = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$emp_ruc);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_empresa_restart($emp_ruc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE empresas
                SET
                    busqueda = 0,
                    fecha_busqueda = NULL,
                    fech_modi=now()
                WHERE
                    ruc = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$emp_ruc);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_empresa_meses($cant){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE empresas
                SET
                    cant_mes = ? ;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cant);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_empresa_x_ruc($emp_ruc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT ruc, empleador, DATE_FORMAT(f_inic_act, '%d-%m-%Y') AS f_inic_act , DATE_FORMAT(f_baja_act, '%d-%m-%Y') AS f_baja_act FROM empresas WHERE ruc = ? AND est = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$emp_ruc);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_empresa_ruc($emp_ruc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM empresas WHERE ruc = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$emp_ruc);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }



        
        
    }
?>