<?php 
    class Lista extends Conectar{

        public function get_lista(){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT lt.id, af.nombres, af.ap_pa, lt.num_doc, lt.cantidad, lt.tipo FROM lista lt INNER JOIN afiliados af ON af.id = lt.id_afiliado WHERE lt.estado = 1;";
            $sql = "SELECT lt.*, af.nombres, af.ap_pa FROM lista lt 
            INNER JOIN afiliados af ON af.id = lt.id_afiliado 
            WHERE lt.estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


        public function insert_lista_pension($id_afiliado, $num_doc, $cantidad, $tipo, $fech_nac, 
                $fech1, $fech_final_1, $tipo_1, $base_1, $estado_1, $condicion_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $tipo_2, $base_2, $estado_2, $condicion_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $tipo_3, $base_3, $estado_3, $condicion_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $tipo_4, $base_4, $estado_4, $condicion_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $tipo_5, $base_5, $estado_5, $condicion_5, $ruc5, $cargo5, $firmante5, $logo5)
            {

            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lista(id, id_afiliado, num_doc, cantidad, tipo, fech_nac, 
                fech1, fech_final_1, tipo_1, base_1, estado_1, condicion_1, ruc1, cargo1, firmante1, logo1, 
                fech2, fech_final_2, tipo_2, base_2, estado_2, condicion_2, ruc2, cargo2, firmante2, logo2, 
                fech3, fech_final_3, tipo_3, base_3, estado_3, condicion_3, ruc3, cargo3, firmante3, logo3, 
                fech4, fech_final_4, tipo_4, base_4, estado_4, condicion_4, ruc4, cargo4, firmante4, logo4, 
                fech5, fech_final_5, tipo_5, base_5, estado_5, condicion_5, ruc5, cargo5, firmante5, logo5, fech_crea, fech_modi, fech_elim, estado) VALUES (
                  NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_afiliado);
            $sql->bindValue(2,$num_doc);
            $sql->bindValue(3,$cantidad);
            $sql->bindValue(4,$tipo);
            $sql->bindValue(5,$fech_nac);
            $sql->bindValue(6,$fech1);
            $sql->bindValue(7,$fech_final_1);
            $sql->bindValue(8,$tipo_1);
            $sql->bindValue(9,$base_1);
            $sql->bindValue(10,$estado_1);
            $sql->bindValue(11,$condicion_1);
            $sql->bindValue(12,$ruc1);
            $sql->bindValue(13,$cargo1);
            $sql->bindValue(14,$firmante1);
            $sql->bindValue(15,$logo1);
            $sql->bindValue(16,$fech2);
            $sql->bindValue(17,$fech_final_2);
            $sql->bindValue(18,$tipo_2);
            $sql->bindValue(19,$base_2);
            $sql->bindValue(20,$estado_2);
            $sql->bindValue(21,$condicion_2);
            $sql->bindValue(22,$ruc2);
            $sql->bindValue(23,$cargo2);
            $sql->bindValue(24,$firmante2);
            $sql->bindValue(25,$logo2);
            $sql->bindValue(26,$fech3);
            $sql->bindValue(27,$fech_final_3);
            $sql->bindValue(28,$tipo_3);
            $sql->bindValue(29,$base_3);
            $sql->bindValue(30,$estado_3);
            $sql->bindValue(31,$condicion_3);
            $sql->bindValue(32,$ruc3);
            $sql->bindValue(33,$cargo3);
            $sql->bindValue(34,$firmante3);
            $sql->bindValue(35,$logo3);
            $sql->bindValue(36,$fech4);
            $sql->bindValue(37,$fech_final_4);
            $sql->bindValue(38,$tipo_4);
            $sql->bindValue(39,$base_4);
            $sql->bindValue(40,$estado_4);
            $sql->bindValue(41,$condicion_4);
            $sql->bindValue(42,$ruc4);
            $sql->bindValue(43,$cargo4);
            $sql->bindValue(44,$firmante4);
            $sql->bindValue(45,$logo4);
            $sql->bindValue(46,$fech5);
            $sql->bindValue(47,$fech_final_5);
            $sql->bindValue(48,$tipo_5);
            $sql->bindValue(49,$base_5);
            $sql->bindValue(50,$estado_5);
            $sql->bindValue(51,$condicion_5);
            $sql->bindValue(52,$ruc5);
            $sql->bindValue(53,$cargo5);
            $sql->bindValue(54,$firmante5);
            $sql->bindValue(55,$logo5);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);

        }

        public function update_lista_pension($id_afiliado, $num_doc, $cantidad, $tipo, $fech_nac, 
        $fech1, $fech_final_1, $tipo_1, $base_1, $estado_1, $condicion_1, $ruc1, $cargo1, $firmante1, $logo1,
        $fech2, $fech_final_2, $tipo_2, $base_2, $estado_2, $condicion_2, $ruc2, $cargo2, $firmante2, $logo2,
        $fech3, $fech_final_3, $tipo_3, $base_3, $estado_3, $condicion_3, $ruc3, $cargo3, $firmante3, $logo3,
        $fech4, $fech_final_4, $tipo_4, $base_4, $estado_4, $condicion_4, $ruc4, $cargo4, $firmante4, $logo4,
        $fech5, $fech_final_5, $tipo_5, $base_5, $estado_5, $condicion_5, $ruc5, $cargo5, $firmante5, $logo5, $idpension)
            {

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE  lista
                SET
                    id_afiliado = ?,
                    num_doc = ?,
                    cantidad = ?,
                    fech_nac = ?, 
                    fech1 = ?,
                    fech_final_1 = ?,
                    tipo_1 = ?,
                    base_1 = ?,
                    estado_1 = ?,
                    condicion_1 = ?,
                    ruc1 = ?,
                    cargo1 = ?,
                    firmante1 = ?,
                    logo1 = ?, 
                    fech2 = ?,
                    fech_final_2 = ?,
                    tipo_2 = ?,
                    base_2 = ?,
                    estado_2 = ?,
                    condicion_2 = ?,
                    ruc2 = ?,
                    cargo2 = ?,
                    firmante2 = ?,
                    logo2 = ?,  
                    fech3 = ?,
                    fech_final_3 = ?,
                    tipo_3 = ?,
                    base_3 = ?,
                    estado_3 = ?,
                    condicion_3 = ?,
                    ruc3 = ?,
                    cargo3 = ?,
                    firmante3 = ?,
                    logo3 = ?,  
                    fech4 = ?,
                    fech_final_4 = ?,
                    tipo_4 = ?,
                    base_4 = ?,
                    estado_5 = ?,
                    condicion_4 = ?,
                    ruc4 = ?,
                    cargo4 = ?,
                    firmante4 = ?,
                    logo4 = ?,
                    fech5 = ?,
                    fech_final_5 = ?,
                    tipo_5 = ?,
                    base_5 = ?,
                    estado_5 = ?,
                    condicion_5 = ?,
                    ruc5 = ?,
                    cargo5 = ?,
                    firmante5 = ?,
                    logo5 = ?,
                    fech_modi = now()
                WHERE 
                    id = ? AND tipo = ? ;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_afiliado);
            $sql->bindValue(2,$num_doc);
            $sql->bindValue(3,$cantidad);
            $sql->bindValue(4,$fech_nac);
            $sql->bindValue(5,$fech1);
            $sql->bindValue(6,$fech_final_1);
            $sql->bindValue(7,$tipo_1);
            $sql->bindValue(8,$base_1);
            $sql->bindValue(9,$estado_1);
            $sql->bindValue(10,$condicion_1);
            $sql->bindValue(11,$ruc1);
            $sql->bindValue(12,$cargo1);
            $sql->bindValue(13,$firmante1);
            $sql->bindValue(14,$logo1);
            $sql->bindValue(15,$fech2);
            $sql->bindValue(16,$fech_final_2);
            $sql->bindValue(17,$tipo_2);
            $sql->bindValue(18,$base_2);
            $sql->bindValue(19,$estado_2);
            $sql->bindValue(20,$condicion_2);
            $sql->bindValue(21,$ruc2);
            $sql->bindValue(22,$cargo2);
            $sql->bindValue(23,$firmante2);
            $sql->bindValue(24,$logo2);
            $sql->bindValue(25,$fech3);
            $sql->bindValue(26,$fech_final_3);
            $sql->bindValue(27,$tipo_3);
            $sql->bindValue(28,$base_3);
            $sql->bindValue(29,$estado_3);
            $sql->bindValue(30,$condicion_3);
            $sql->bindValue(31,$ruc3);
            $sql->bindValue(32,$cargo3);
            $sql->bindValue(33,$firmante3);
            $sql->bindValue(34,$logo3);
            $sql->bindValue(35,$fech4);
            $sql->bindValue(36,$fech_final_4);
            $sql->bindValue(37,$tipo_4);
            $sql->bindValue(38,$base_4);
            $sql->bindValue(39,$estado_4);
            $sql->bindValue(40,$condicion_4);
            $sql->bindValue(41,$ruc4);
            $sql->bindValue(42,$cargo4);
            $sql->bindValue(43,$firmante4);
            $sql->bindValue(44,$logo4);
            $sql->bindValue(45,$fech5);
            $sql->bindValue(46,$fech_final_5);
            $sql->bindValue(47,$tipo_5);
            $sql->bindValue(48,$base_5);
            $sql->bindValue(49,$estado_5);
            $sql->bindValue(50,$condicion_5);
            $sql->bindValue(51,$ruc5);
            $sql->bindValue(52,$cargo5);
            $sql->bindValue(53,$firmante5);
            $sql->bindValue(54,$logo5);
            $sql->bindValue(55,$idpension);
            $sql->bindValue(56,$tipo);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_lista_x_doc($dni, $lista){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM lista WHERE num_doc = ? AND tipo = ?  AND estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dni);
            $sql->bindValue(2,$lista);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_lista_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT lt.*, af.nombres, af.ap_pa, af.tipo_doc FROM lista lt 
                    INNER JOIN afiliados af ON af.id = lt.id_afiliado 
                    WHERE lt.id = ? AND lt.estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        

        public function delete_lista($lista_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lista
                SET
                    estado=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$lista_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }