<?php 
    class Listareporte extends Conectar{

        public function get_lista_reporte(){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT lt.id, af.nombres, af.ap_pa, lt.num_doc, lt.cantidad, lt.tipo FROM lista lt INNER JOIN afiliados af ON af.id = lt.id_afiliado WHERE lt.estado = 1;";
            $sql = "SELECT lt.*, af.nombres, af.ap_pa FROM listareporte lt 
            INNER JOIN afiliados af ON af.id = lt.id_afiliado 
            WHERE lt.estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


        public function insert_lista_reporte_pension($id_afiliado, $num_doc, $cantidad, $cantidad_orc, $cantidad_ht, $tipo, $fech_nac,
                $fech_orc_1, $fech_final_orc_1, $ruc_orc_1, $cargo_orc_1, $firmante_orc_1, $logo_orc_1,
                $fech_orc_2, $fech_final_orc_2, $ruc_orc_2, $cargo_orc_2, $firmante_orc_2, $logo_orc_2,
                $fech_orc_3, $fech_final_orc_3, $ruc_orc_3, $cargo_orc_3, $firmante_orc_3, $logo_orc_3,
                $fech_orc_4, $fech_final_orc_4, $ruc_orc_4, $cargo_orc_4, $firmante_orc_4, $logo_orc_4,
                $fech_ht_1, $fech_final_ht_1, $ruc_ht_1, $cargo_ht_1, $firmante_ht_1, $logo_ht_1, 
                $fech_ht_2, $fech_final_ht_2, $ruc_ht_2, $cargo_ht_2, $firmante_ht_2, $logo_ht_2, 
                $fech_ht_3, $fech_final_ht_3, $ruc_ht_3, $cargo_ht_3, $firmante_ht_3, $logo_ht_3, 
                $fech_ht_4, $fech_final_ht_4, $ruc_ht_4, $cargo_ht_4, $firmante_ht_4, $logo_ht_4, $meses_flx, 
                $fech1, $fech_final_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $ruc5, $cargo5, $firmante5, $logo5)
            {

            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO listareporte (id, id_afiliado, num_doc, cantidad, cantidad_orc, cantidad_ht, tipo, fech_nac,
                fech_orcinea_1, fech_final_orcinea_1, ruc_orcinea_1, cargo_orcinea_1, firmante_orcinea_1, logo_orcinea_1,
                fech_orcinea_2, fech_final_orcinea_2, ruc_orcinea_2, cargo_orcinea_2, firmante_orcinea_2, logo_orcinea_2,
                fech_orcinea_3, fech_final_orcinea_3, ruc_orcinea_3, cargo_orcinea_3, firmante_orcinea_3, logo_orcinea_3,
                fech_orcinea_4, fech_final_orcinea_4, ruc_orcinea_4, cargo_orcinea_4, firmante_orcinea_4, logo_orcinea_4,
                fech_host_1, fech_final_host_1, ruc_host_1, cargo_host_1, firmante_host_1, logo_host_1, 
                fech_host_2, fech_final_host_2, ruc_host_2, cargo_host_2, firmante_host_2, logo_host_2, 
                fech_host_3, fech_final_host_3, ruc_host_3, cargo_host_3, firmante_host_3, logo_host_3, 
                fech_host_4, fech_final_host_4, ruc_host_4, cargo_host_4, firmante_host_4, logo_host_4, meses_reflex, 
                fech1, fech_final_1, ruc1, cargo1, firmante1, logo1, 
                fech2, fech_final_2, ruc2, cargo2, firmante2, logo2, 
                fech3, fech_final_3, ruc3, cargo3, firmante3, logo3, 
                fech4, fech_final_4, ruc4, cargo4, firmante4, logo4, 
                fech5, fech_final_5, ruc5, cargo5, firmante5, logo5, fech_crea, fech_modi, fech_elim, estado) VALUES (
                  NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_afiliado);
            $sql->bindValue(2,$num_doc);
            $sql->bindValue(3,$cantidad);
            $sql->bindValue(4,$cantidad_orc);
            $sql->bindValue(5,$cantidad_ht);
            $sql->bindValue(6,$tipo);
            $sql->bindValue(7,$fech_nac);
            $sql->bindValue(8,$fech_orc_1);
            $sql->bindValue(9,$fech_final_orc_1);
            $sql->bindValue(10,$ruc_orc_1);
            $sql->bindValue(11,$cargo_orc_1);
            $sql->bindValue(12,$firmante_orc_1);
            $sql->bindValue(13,$logo_orc_1);
            $sql->bindValue(14,$fech_orc_2);
            $sql->bindValue(15,$fech_final_orc_2);
            $sql->bindValue(16,$ruc_orc_2);
            $sql->bindValue(17,$cargo_orc_2);
            $sql->bindValue(18,$firmante_orc_2);
            $sql->bindValue(19,$logo_orc_2);
            $sql->bindValue(20,$fech_orc_3);
            $sql->bindValue(21,$fech_final_orc_3);
            $sql->bindValue(22,$ruc_orc_3);
            $sql->bindValue(23,$cargo_orc_3);
            $sql->bindValue(24,$firmante_orc_3);
            $sql->bindValue(25,$logo_orc_3);
            $sql->bindValue(26,$fech_orc_4);
            $sql->bindValue(27,$fech_final_orc_4);
            $sql->bindValue(28,$ruc_orc_4);
            $sql->bindValue(29,$cargo_orc_4);
            $sql->bindValue(30,$firmante_orc_4);
            $sql->bindValue(31,$logo_orc_4);
            $sql->bindValue(32,$fech_ht_1);
            $sql->bindValue(33,$fech_final_ht_1);
            $sql->bindValue(34,$ruc_ht_1);
            $sql->bindValue(35,$cargo_ht_1);
            $sql->bindValue(36,$firmante_ht_1);
            $sql->bindValue(37,$logo_ht_1);
            $sql->bindValue(38,$fech_ht_2);
            $sql->bindValue(39,$fech_final_ht_2);
            $sql->bindValue(40,$ruc_ht_2);
            $sql->bindValue(41,$cargo_ht_2);
            $sql->bindValue(42,$firmante_ht_2);
            $sql->bindValue(43,$logo_ht_2);
            $sql->bindValue(44,$fech_ht_3);
            $sql->bindValue(45,$fech_final_ht_3);
            $sql->bindValue(46,$ruc_ht_3);
            $sql->bindValue(47,$cargo_ht_3);
            $sql->bindValue(48,$firmante_ht_3);
            $sql->bindValue(49,$logo_ht_3);
            $sql->bindValue(50,$fech_ht_4);
            $sql->bindValue(51,$fech_final_ht_4);
            $sql->bindValue(52,$ruc_ht_4);
            $sql->bindValue(53,$cargo_ht_4);
            $sql->bindValue(54,$firmante_ht_4);
            $sql->bindValue(55,$logo_ht_4);
            $sql->bindValue(56,$meses_flx);
            $sql->bindValue(57,$fech1);
            $sql->bindValue(58,$fech_final_1);
            $sql->bindValue(59,$ruc1);
            $sql->bindValue(60,$cargo1);
            $sql->bindValue(61,$firmante1);
            $sql->bindValue(62,$logo1);
            $sql->bindValue(63,$fech2);
            $sql->bindValue(64,$fech_final_2);
            $sql->bindValue(65,$ruc2);
            $sql->bindValue(66,$cargo2);
            $sql->bindValue(67,$firmante2);
            $sql->bindValue(68,$logo2);
            $sql->bindValue(69,$fech3);
            $sql->bindValue(70,$fech_final_3);
            $sql->bindValue(71,$ruc3);
            $sql->bindValue(72,$cargo3);
            $sql->bindValue(73,$firmante3);
            $sql->bindValue(74,$logo3);
            $sql->bindValue(75,$fech4);
            $sql->bindValue(76,$fech_final_4);
            $sql->bindValue(77,$ruc4);
            $sql->bindValue(78,$cargo4);
            $sql->bindValue(79,$firmante4);
            $sql->bindValue(80,$logo4);
            $sql->bindValue(81,$fech5);
            $sql->bindValue(82,$fech_final_5);
            $sql->bindValue(83,$ruc5);
            $sql->bindValue(84,$cargo5);
            $sql->bindValue(85,$firmante5);
            $sql->bindValue(86,$logo5);
            $sql->execute();

        }

        public function update_lista_reporte_pension($id_afiliado, $num_doc, $cantidad, $cantidad_orc, $cantidad_ht, $tipo, $fech_nac, 
                $fech_orc_1, $fech_final_orc_1, $ruc_orc_1, $cargo_orc_1, $firmante_orc_1, $logo_orc_1,
                $fech_orc_2, $fech_final_orc_2, $ruc_orc_2, $cargo_orc_2, $firmante_orc_2, $logo_orc_2,
                $fech_orc_3, $fech_final_orc_3, $ruc_orc_3, $cargo_orc_3, $firmante_orc_3, $logo_orc_3,
                $fech_orc_4, $fech_final_orc_4, $ruc_orc_4, $cargo_orc_4, $firmante_orc_4, $logo_orc_4,
                $fech_ht_1, $fech_final_ht_1, $ruc_ht_1, $cargo_ht_1, $firmante_ht_1, $logo_ht_1, 
                $fech_ht_2, $fech_final_ht_2, $ruc_ht_2, $cargo_ht_2, $firmante_ht_2, $logo_ht_2, 
                $fech_ht_3, $fech_final_ht_3, $ruc_ht_3, $cargo_ht_3, $firmante_ht_3, $logo_ht_3, 
                $fech_ht_4, $fech_final_ht_4, $ruc_ht_4, $cargo_ht_4, $firmante_ht_4, $logo_ht_4, $meses_flx, 
                $fech1, $fech_final_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $ruc5, $cargo5, $firmante5, $logo5, $idpension)
            {

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE  listareporte
                SET
                    id_afiliado = ?,
                    num_doc = ?,
                    cantidad = ?,
                    cantidad_orc = ?,
                    cantidad_ht = ?,
                    fech_nac = ?, 
                    fech_orcinea_1 = ?,
                    fech_final_orcinea_1 = ?,
                    ruc_orcinea_1 = ?,
                    cargo_orcinea_1 = ?,
                    firmante_orcinea_1 = ?,
                    logo_orcinea_1 = ?,
                    fech_orcinea_2 = ?,
                    fech_final_orcinea_2 = ?,
                    ruc_orcinea_2 = ?,
                    cargo_orcinea_2 = ?,
                    firmante_orcinea_2 = ?,
                    logo_orcinea_2 = ?,
                    fech_orcinea_3 = ?,
                    fech_final_orcinea_3 = ?,
                    ruc_orcinea_3 = ?,
                    cargo_orcinea_3 = ?,
                    firmante_orcinea_3 = ?,
                    logo_orcinea_3 = ?,
                    fech_orcinea_4 = ?,
                    fech_final_orcinea_4 = ?,
                    ruc_orcinea_4 = ?,
                    cargo_orcinea_4 = ?,
                    firmante_orcinea_4 = ?,
                    logo_orcinea_4 = ?,
                    fech_host_1 = ?,
                    fech_final_host_1 = ?,
                    ruc_host_1 = ?,
                    cargo_host_1 = ?,
                    firmante_host_1 = ?,
                    logo_host_1 = ?,
                    fech_host_2 = ?,
                    fech_final_host_2 = ?,
                    ruc_host_2 = ?,
                    cargo_host_2 = ?,
                    firmante_host_2 = ?,
                    logo_host_2 = ?,
                    fech_host_3 = ?,
                    fech_final_host_3 = ?,
                    ruc_host_3 = ?,
                    cargo_host_3 = ?,
                    firmante_host_3 = ?,
                    logo_host_3 = ?,
                    fech_host_4 = ?,
                    fech_final_host_4 = ?,
                    ruc_host_4 = ?,
                    cargo_host_4 = ?,
                    firmante_host_4 = ?,
                    logo_host_4 = ?,
                    meses_reflex = ?, 
                    fech1 = ?,
                    fech_final_1 = ?,
                    ruc1 = ?,
                    cargo1 = ?,
                    firmante1 = ?,
                    logo1 = ?, 
                    fech2 = ?,
                    fech_final_2 = ?,
                    ruc2 = ?,
                    cargo2 = ?,
                    firmante2 = ?,
                    logo2 = ?,  
                    fech3 = ?,
                    fech_final_3 = ?,
                    ruc3 = ?,
                    cargo3 = ?,
                    firmante3 = ?,
                    logo3 = ?,  
                    fech4 = ?,
                    fech_final_4 = ?,
                    ruc4 = ?,
                    cargo4 = ?,
                    firmante4 = ?,
                    logo4 = ?,
                    fech5 = ?,
                    fech_final_5 = ?,
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
            $sql->bindValue(4,$cantidad_orc);
            $sql->bindValue(5,$cantidad_ht);
            $sql->bindValue(6,$fech_nac);
            $sql->bindValue(7,$fech_orc_1);
            $sql->bindValue(8,$fech_final_orc_1);
            $sql->bindValue(9,$ruc_orc_1);
            $sql->bindValue(10,$cargo_orc_1);
            $sql->bindValue(11,$firmante_orc_1);
            $sql->bindValue(12,$logo_orc_1);
            $sql->bindValue(13,$fech_orc_2);
            $sql->bindValue(14,$fech_final_orc_2);
            $sql->bindValue(15,$ruc_orc_2);
            $sql->bindValue(16,$cargo_orc_2);
            $sql->bindValue(17,$firmante_orc_2);
            $sql->bindValue(18,$logo_orc_2);
            $sql->bindValue(19,$fech_orc_3);
            $sql->bindValue(20,$fech_final_orc_3);
            $sql->bindValue(21,$ruc_orc_3);
            $sql->bindValue(22,$cargo_orc_3);
            $sql->bindValue(23,$firmante_orc_3);
            $sql->bindValue(24,$logo_orc_3);
            $sql->bindValue(25,$fech_orc_4);
            $sql->bindValue(26,$fech_final_orc_4);
            $sql->bindValue(27,$ruc_orc_4);
            $sql->bindValue(28,$cargo_orc_4);
            $sql->bindValue(29,$firmante_orc_4);
            $sql->bindValue(30,$logo_orc_4);
            $sql->bindValue(31,$fech_ht_1);
            $sql->bindValue(32,$fech_final_ht_1);
            $sql->bindValue(33,$ruc_ht_1);
            $sql->bindValue(34,$cargo_ht_1);
            $sql->bindValue(35,$firmante_ht_1);
            $sql->bindValue(36,$logo_ht_1);
            $sql->bindValue(37,$fech_ht_2);
            $sql->bindValue(38,$fech_final_ht_2);
            $sql->bindValue(39,$ruc_ht_2);
            $sql->bindValue(40,$cargo_ht_2);
            $sql->bindValue(41,$firmante_ht_2);
            $sql->bindValue(42,$logo_ht_2);
            $sql->bindValue(43,$fech_ht_3);
            $sql->bindValue(44,$fech_final_ht_3);
            $sql->bindValue(45,$ruc_ht_3);
            $sql->bindValue(46,$cargo_ht_3);
            $sql->bindValue(47,$firmante_ht_3);
            $sql->bindValue(48,$logo_ht_3);
            $sql->bindValue(49,$fech_ht_4);
            $sql->bindValue(50,$fech_final_ht_4);
            $sql->bindValue(51,$ruc_ht_4);
            $sql->bindValue(52,$cargo_ht_4);
            $sql->bindValue(53,$firmante_ht_4);
            $sql->bindValue(54,$logo_ht_4);
            $sql->bindValue(55,$meses_flx);
            $sql->bindValue(56,$fech1);
            $sql->bindValue(57,$fech_final_1);
            $sql->bindValue(58,$ruc1);
            $sql->bindValue(59,$cargo1);
            $sql->bindValue(60,$firmante1);
            $sql->bindValue(61,$logo1);
            $sql->bindValue(62,$fech2);
            $sql->bindValue(63,$fech_final_2);
            $sql->bindValue(64,$ruc2);
            $sql->bindValue(65,$cargo2);
            $sql->bindValue(66,$firmante2);
            $sql->bindValue(67,$logo2);
            $sql->bindValue(68,$fech3);
            $sql->bindValue(69,$fech_final_3);
            $sql->bindValue(70,$ruc3);
            $sql->bindValue(71,$cargo3);
            $sql->bindValue(72,$firmante3);
            $sql->bindValue(73,$logo3);
            $sql->bindValue(74,$fech4);
            $sql->bindValue(75,$fech_final_4);
            $sql->bindValue(76,$ruc4);
            $sql->bindValue(77,$cargo4);
            $sql->bindValue(78,$firmante4);
            $sql->bindValue(79,$logo4);
            $sql->bindValue(80,$fech5);
            $sql->bindValue(81,$fech_final_5);
            $sql->bindValue(82,$ruc5);
            $sql->bindValue(83,$cargo5);
            $sql->bindValue(84,$firmante5);
            $sql->bindValue(85,$logo5);
            $sql->bindValue(86,$idpension);
            $sql->bindValue(87,$tipo);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_lista_reporte_x_doc($dni, $lista){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM listareporte WHERE num_doc = ? AND tipo = ?  AND estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dni);
            $sql->bindValue(2,$lista);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_lista_reporte_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT lt.*, af.nombres, af.ap_pa, af.tipo_doc FROM listareporte lt 
                    INNER JOIN afiliados af ON af.id = lt.id_afiliado 
                    WHERE lt.id = ? AND lt.estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        

        public function delete_lista_reporte($lista_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE listareporte
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