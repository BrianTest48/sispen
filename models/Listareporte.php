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
                $fech_orc_1, $fech_final_orc_1, $tipo_orc_1, $ruc_orc_1, $cargo_orc_1, $firmante_orc_1, $logo_orc_1,
                $fech_orc_2, $fech_final_orc_2, $tipo_orc_2, $ruc_orc_2, $cargo_orc_2, $firmante_orc_2, $logo_orc_2,
                $fech_orc_3, $fech_final_orc_3, $tipo_orc_3, $ruc_orc_3, $cargo_orc_3, $firmante_orc_3, $logo_orc_3,
                $fech_orc_4, $fech_final_orc_4, $tipo_orc_4, $ruc_orc_4, $cargo_orc_4, $firmante_orc_4, $logo_orc_4,
                $fech_ht_1, $fech_final_ht_1, $tipo_host_1, $ruc_ht_1, $cargo_ht_1, $firmante_ht_1, $logo_ht_1, 
                $fech_ht_2, $fech_final_ht_2, $tipo_host_2, $ruc_ht_2, $cargo_ht_2, $firmante_ht_2, $logo_ht_2, 
                $fech_ht_3, $fech_final_ht_3, $tipo_host_3, $ruc_ht_3, $cargo_ht_3, $firmante_ht_3, $logo_ht_3, 
                $fech_ht_4, $fech_final_ht_4, $tipo_host_4, $ruc_ht_4, $cargo_ht_4, $firmante_ht_4, $logo_ht_4, $meses_flx, 
                $fech1, $fech_final_1, $tipo_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $tipo_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $tipo_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $tipo_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $tipo_5, $ruc5, $cargo5, $firmante5, $logo5)
            {

            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO listareporte (id, id_afiliado, num_doc, cantidad, cantidad_orc, cantidad_ht, tipo, fech_nac,
                fech_orcinea_1, fech_final_orcinea_1, tipo_orc_1, ruc_orcinea_1, cargo_orcinea_1, firmante_orcinea_1, logo_orcinea_1,
                fech_orcinea_2, fech_final_orcinea_2, tipo_orc_2, ruc_orcinea_2, cargo_orcinea_2, firmante_orcinea_2, logo_orcinea_2,
                fech_orcinea_3, fech_final_orcinea_3, tipo_orc_3, ruc_orcinea_3, cargo_orcinea_3, firmante_orcinea_3, logo_orcinea_3,
                fech_orcinea_4, fech_final_orcinea_4, tipo_orc_4, ruc_orcinea_4, cargo_orcinea_4, firmante_orcinea_4, logo_orcinea_4,
                fech_host_1, fech_final_host_1, tipo_host_1, ruc_host_1, cargo_host_1, firmante_host_1, logo_host_1, 
                fech_host_2, fech_final_host_2, tipo_host_2, ruc_host_2, cargo_host_2, firmante_host_2, logo_host_2, 
                fech_host_3, fech_final_host_3, tipo_host_3, ruc_host_3, cargo_host_3, firmante_host_3, logo_host_3, 
                fech_host_4, fech_final_host_4, tipo_host_4, ruc_host_4, cargo_host_4, firmante_host_4, logo_host_4, meses_reflex, 
                fech1, fech_final_1, tipo_1, ruc1, cargo1, firmante1, logo1, 
                fech2, fech_final_2, tipo_2, ruc2, cargo2, firmante2, logo2, 
                fech3, fech_final_3, tipo_3, ruc3, cargo3, firmante3, logo3, 
                fech4, fech_final_4, tipo_4, ruc4, cargo4, firmante4, logo4, 
                fech5, fech_final_5, tipo_5, ruc5, cargo5, firmante5, logo5, fech_crea, fech_modi, fech_elim, estado) VALUES (
                  NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), NULL, NULL, 1);";
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
            $sql->bindValue(10,$tipo_orc_1);
            $sql->bindValue(11,$ruc_orc_1);
            $sql->bindValue(12,$cargo_orc_1);
            $sql->bindValue(13,$firmante_orc_1);
            $sql->bindValue(14,$logo_orc_1);
            $sql->bindValue(15,$fech_orc_2);
            $sql->bindValue(16,$fech_final_orc_2);
            $sql->bindValue(17,$tipo_orc_2);
            $sql->bindValue(18,$ruc_orc_2);
            $sql->bindValue(19,$cargo_orc_2);
            $sql->bindValue(20,$firmante_orc_2);
            $sql->bindValue(21,$logo_orc_2);
            $sql->bindValue(22,$fech_orc_3);
            $sql->bindValue(23,$fech_final_orc_3);
            $sql->bindValue(24,$tipo_orc_3);
            $sql->bindValue(25,$ruc_orc_3);
            $sql->bindValue(26,$cargo_orc_3);
            $sql->bindValue(27,$firmante_orc_3);
            $sql->bindValue(28,$logo_orc_3);
            $sql->bindValue(29,$fech_orc_4);
            $sql->bindValue(30,$fech_final_orc_4);
            $sql->bindValue(31,$tipo_orc_4);
            $sql->bindValue(32,$ruc_orc_4);
            $sql->bindValue(33,$cargo_orc_4);
            $sql->bindValue(34,$firmante_orc_4);
            $sql->bindValue(35,$logo_orc_4);
            $sql->bindValue(36,$fech_ht_1);
            $sql->bindValue(37,$fech_final_ht_1);
            $sql->bindValue(38,$tipo_host_1);
            $sql->bindValue(39,$ruc_ht_1);
            $sql->bindValue(40,$cargo_ht_1);
            $sql->bindValue(41,$firmante_ht_1);
            $sql->bindValue(42,$logo_ht_1);
            $sql->bindValue(43,$fech_ht_2);
            $sql->bindValue(44,$fech_final_ht_2);
            $sql->bindValue(45,$tipo_host_2);
            $sql->bindValue(46,$ruc_ht_2);
            $sql->bindValue(47,$cargo_ht_2);
            $sql->bindValue(48,$firmante_ht_2);
            $sql->bindValue(49,$logo_ht_2);
            $sql->bindValue(50,$fech_ht_3);
            $sql->bindValue(51,$fech_final_ht_3);
            $sql->bindValue(52,$tipo_host_3);
            $sql->bindValue(53,$ruc_ht_3);
            $sql->bindValue(54,$cargo_ht_3);
            $sql->bindValue(55,$firmante_ht_3);
            $sql->bindValue(56,$logo_ht_3);
            $sql->bindValue(57,$fech_ht_4);
            $sql->bindValue(58,$fech_final_ht_4);
            $sql->bindValue(59,$tipo_host_4);
            $sql->bindValue(60,$ruc_ht_4);
            $sql->bindValue(61,$cargo_ht_4);
            $sql->bindValue(62,$firmante_ht_4);
            $sql->bindValue(63,$logo_ht_4);
            $sql->bindValue(64,$meses_flx);
            $sql->bindValue(65,$fech1);
            $sql->bindValue(66,$fech_final_1);
            $sql->bindValue(67,$tipo_1);
            $sql->bindValue(68,$ruc1);
            $sql->bindValue(69,$cargo1);
            $sql->bindValue(70,$firmante1);
            $sql->bindValue(71,$logo1);
            $sql->bindValue(72,$fech2);
            $sql->bindValue(73,$fech_final_2);
            $sql->bindValue(74,$tipo_2);
            $sql->bindValue(75,$ruc2);
            $sql->bindValue(76,$cargo2);
            $sql->bindValue(77,$firmante2);
            $sql->bindValue(78,$logo2);
            $sql->bindValue(79,$fech3);
            $sql->bindValue(80,$fech_final_3);
            $sql->bindValue(81,$tipo_3);
            $sql->bindValue(82,$ruc3);
            $sql->bindValue(83,$cargo3);
            $sql->bindValue(84,$firmante3);
            $sql->bindValue(85,$logo3);
            $sql->bindValue(86,$fech4);
            $sql->bindValue(87,$fech_final_4);
            $sql->bindValue(88,$tipo_4);
            $sql->bindValue(89,$ruc4);
            $sql->bindValue(90,$cargo4);
            $sql->bindValue(91,$firmante4);
            $sql->bindValue(92,$logo4);
            $sql->bindValue(93,$fech5);
            $sql->bindValue(94,$fech_final_5);
            $sql->bindValue(95,$tipo_5);
            $sql->bindValue(96,$ruc5);
            $sql->bindValue(97,$cargo5);
            $sql->bindValue(98,$firmante5);
            $sql->bindValue(99,$logo5);
            $sql->execute();

        }

        public function update_lista_reporte_pension($id_afiliado, $num_doc, $cantidad, $cantidad_orc, $cantidad_ht, $tipo, $fech_nac, 
                $fech_orc_1, $fech_final_orc_1, $tipo_orc_1, $ruc_orc_1, $cargo_orc_1, $firmante_orc_1, $logo_orc_1,
                $fech_orc_2, $fech_final_orc_2, $tipo_orc_2, $ruc_orc_2, $cargo_orc_2, $firmante_orc_2, $logo_orc_2,
                $fech_orc_3, $fech_final_orc_3, $tipo_orc_3, $ruc_orc_3, $cargo_orc_3, $firmante_orc_3, $logo_orc_3,
                $fech_orc_4, $fech_final_orc_4, $tipo_orc_4, $ruc_orc_4, $cargo_orc_4, $firmante_orc_4, $logo_orc_4,
                $fech_ht_1, $fech_final_ht_1, $tipo_host_1, $ruc_ht_1, $cargo_ht_1, $firmante_ht_1, $logo_ht_1, 
                $fech_ht_2, $fech_final_ht_2, $tipo_host_2, $ruc_ht_2, $cargo_ht_2, $firmante_ht_2, $logo_ht_2, 
                $fech_ht_3, $fech_final_ht_3, $tipo_host_3, $ruc_ht_3, $cargo_ht_3, $firmante_ht_3, $logo_ht_3, 
                $fech_ht_4, $fech_final_ht_4, $tipo_host_4, $ruc_ht_4, $cargo_ht_4, $firmante_ht_4, $logo_ht_4, $meses_flx, 
                $fech1, $fech_final_1, $tipo_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $tipo_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $tipo_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $tipo_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $tipo_5, $ruc5, $cargo5, $firmante5, $logo5, $idpension)
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
                    tipo_orc_1 = ?,
                    ruc_orcinea_1 = ?,
                    cargo_orcinea_1 = ?,
                    firmante_orcinea_1 = ?,
                    logo_orcinea_1 = ?,
                    fech_orcinea_2 = ?,
                    fech_final_orcinea_2 = ?,
                    tipo_orc_2 = ?,
                    ruc_orcinea_2 = ?,
                    cargo_orcinea_2 = ?,
                    firmante_orcinea_2 = ?,
                    logo_orcinea_2 = ?,
                    fech_orcinea_3 = ?,
                    fech_final_orcinea_3 = ?,
                    tipo_orc_3 = ?,
                    ruc_orcinea_3 = ?,
                    cargo_orcinea_3 = ?,
                    firmante_orcinea_3 = ?,
                    logo_orcinea_3 = ?,
                    fech_orcinea_4 = ?,
                    fech_final_orcinea_4 = ?,
                    tipo_orc_4 = ?,
                    ruc_orcinea_4 = ?,
                    cargo_orcinea_4 = ?,
                    firmante_orcinea_4 = ?,
                    logo_orcinea_4 = ?,
                    fech_host_1 = ?,
                    fech_final_host_1 = ?,
                    tipo_host_1 = ?,
                    ruc_host_1 = ?,
                    cargo_host_1 = ?,
                    firmante_host_1 = ?,
                    logo_host_1 = ?,
                    fech_host_2 = ?,
                    fech_final_host_2 = ?,
                    tipo_host_2 = ?,
                    ruc_host_2 = ?,
                    cargo_host_2 = ?,
                    firmante_host_2 = ?,
                    logo_host_2 = ?,
                    fech_host_3 = ?,
                    fech_final_host_3 = ?,
                    tipo_host_3 = ?,
                    ruc_host_3 = ?,
                    cargo_host_3 = ?,
                    firmante_host_3 = ?,
                    logo_host_3 = ?,
                    fech_host_4 = ?,
                    fech_final_host_4 = ?,
                    tipo_host_4 = ?,
                    ruc_host_4 = ?,
                    cargo_host_4 = ?,
                    firmante_host_4 = ?,
                    logo_host_4 = ?,
                    meses_reflex = ?, 
                    fech1 = ?,
                    fech_final_1 = ?,
                    tipo_1 = ?,
                    ruc1 = ?,
                    cargo1 = ?,
                    firmante1 = ?,
                    logo1 = ?, 
                    fech2 = ?,
                    fech_final_2 = ?,
                    tipo_2 = ?,
                    ruc2 = ?,
                    cargo2 = ?,
                    firmante2 = ?,
                    logo2 = ?,  
                    fech3 = ?,
                    fech_final_3 = ?,
                    tipo_3 = ?,
                    ruc3 = ?,
                    cargo3 = ?,
                    firmante3 = ?,
                    logo3 = ?,  
                    fech4 = ?,
                    fech_final_4 = ?,
                    tipo_4 = ?,
                    ruc4 = ?,
                    cargo4 = ?,
                    firmante4 = ?,
                    logo4 = ?,
                    fech5 = ?,
                    fech_final_5 = ?,
                    tipo_5 = ?,
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
            $sql->bindValue(9,$tipo_orc_1);
            $sql->bindValue(10,$ruc_orc_1);
            $sql->bindValue(11,$cargo_orc_1);
            $sql->bindValue(12,$firmante_orc_1);
            $sql->bindValue(13,$logo_orc_1);
            $sql->bindValue(14,$fech_orc_2);
            $sql->bindValue(15,$fech_final_orc_2);
            $sql->bindValue(16,$tipo_orc_2);
            $sql->bindValue(17,$ruc_orc_2);
            $sql->bindValue(18,$cargo_orc_2);
            $sql->bindValue(19,$firmante_orc_2);
            $sql->bindValue(20,$logo_orc_2);
            $sql->bindValue(21,$fech_orc_3);
            $sql->bindValue(22,$fech_final_orc_3);
            $sql->bindValue(23,$tipo_orc_3);
            $sql->bindValue(24,$ruc_orc_3);
            $sql->bindValue(25,$cargo_orc_3);
            $sql->bindValue(26,$firmante_orc_3);
            $sql->bindValue(27,$logo_orc_3);
            $sql->bindValue(28,$fech_orc_4);
            $sql->bindValue(29,$fech_final_orc_4);
            $sql->bindValue(30,$tipo_orc_4);
            $sql->bindValue(31,$ruc_orc_4);
            $sql->bindValue(32,$cargo_orc_4);
            $sql->bindValue(33,$firmante_orc_4);
            $sql->bindValue(34,$logo_orc_4);
            $sql->bindValue(35,$fech_ht_1);
            $sql->bindValue(36,$fech_final_ht_1);
            $sql->bindValue(37,$tipo_host_1);
            $sql->bindValue(38,$ruc_ht_1);
            $sql->bindValue(39,$cargo_ht_1);
            $sql->bindValue(40,$firmante_ht_1);
            $sql->bindValue(41,$logo_ht_1);
            $sql->bindValue(42,$fech_ht_2);
            $sql->bindValue(43,$fech_final_ht_2);
            $sql->bindValue(44,$tipo_host_2);
            $sql->bindValue(45,$ruc_ht_2);
            $sql->bindValue(46,$cargo_ht_2);
            $sql->bindValue(47,$firmante_ht_2);
            $sql->bindValue(48,$logo_ht_2);
            $sql->bindValue(49,$fech_ht_3);
            $sql->bindValue(50,$fech_final_ht_3);
            $sql->bindValue(51,$tipo_host_3);
            $sql->bindValue(52,$ruc_ht_3);
            $sql->bindValue(53,$cargo_ht_3);
            $sql->bindValue(54,$firmante_ht_3);
            $sql->bindValue(55,$logo_ht_3);
            $sql->bindValue(56,$fech_ht_4);
            $sql->bindValue(57,$fech_final_ht_4);
            $sql->bindValue(58,$tipo_host_4);
            $sql->bindValue(59,$ruc_ht_4);
            $sql->bindValue(60,$cargo_ht_4);
            $sql->bindValue(61,$firmante_ht_4);
            $sql->bindValue(62,$logo_ht_4);
            $sql->bindValue(63,$meses_flx);
            $sql->bindValue(64,$fech1);
            $sql->bindValue(65,$fech_final_1);
            $sql->bindValue(66,$tipo_1);
            $sql->bindValue(67,$ruc1);
            $sql->bindValue(68,$cargo1);
            $sql->bindValue(69,$firmante1);
            $sql->bindValue(70,$logo1);
            $sql->bindValue(71,$fech2);
            $sql->bindValue(72,$fech_final_2);
            $sql->bindValue(73,$tipo_2);
            $sql->bindValue(74,$ruc2);
            $sql->bindValue(75,$cargo2);
            $sql->bindValue(76,$firmante2);
            $sql->bindValue(77,$logo2);
            $sql->bindValue(78,$fech3);
            $sql->bindValue(79,$fech_final_3);
            $sql->bindValue(80,$tipo_3);
            $sql->bindValue(81,$ruc3);
            $sql->bindValue(82,$cargo3);
            $sql->bindValue(83,$firmante3);
            $sql->bindValue(84,$logo3);
            $sql->bindValue(85,$fech4);
            $sql->bindValue(86,$fech_final_4);
            $sql->bindValue(87,$tipo_4);
            $sql->bindValue(88,$ruc4);
            $sql->bindValue(89,$cargo4);
            $sql->bindValue(90,$firmante4);
            $sql->bindValue(91,$logo4);
            $sql->bindValue(92,$fech5);
            $sql->bindValue(93,$fech_final_5);
            $sql->bindValue(94,$tipo_5);
            $sql->bindValue(95,$ruc5);
            $sql->bindValue(96,$cargo5);
            $sql->bindValue(97,$firmante5);
            $sql->bindValue(98,$logo5);
            $sql->bindValue(99,$idpension);
            $sql->bindValue(100,$tipo);//87
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_lista_reporte_x_doc($dni, $lista){
            $conectar = parent::conexion();
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