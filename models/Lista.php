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
                $fech1, $fech_final_1, $tipo_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $tipo_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $tipo_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $tipo_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $tipo_5, $ruc5, $cargo5, $firmante5, $logo5)
            {

            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lista(id, id_afiliado, num_doc, cantidad, tipo, fech_nac, 
                fech1, fech_final_1, tipo_1, ruc1, cargo1, firmante1, logo1, 
                fech2, fech_final_2, tipo_2, ruc2, cargo2, firmante2, logo2, 
                fech3, fech_final_3, tipo_3, ruc3, cargo3, firmante3, logo3, 
                fech4, fech_final_4, tipo_4, ruc4, cargo4, firmante4, logo4, 
                fech5, fech_final_5, tipo_5, ruc5, cargo5, firmante5, logo5, fech_crea, fech_modi, fech_elim, estado) VALUES (
                  NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_afiliado);
            $sql->bindValue(2,$num_doc);
            $sql->bindValue(3,$cantidad);
            $sql->bindValue(4,$tipo);
            $sql->bindValue(5,$fech_nac);
            $sql->bindValue(6,$fech1);
            $sql->bindValue(7,$fech_final_1);
            $sql->bindValue(8,$tipo_1);
            $sql->bindValue(9,$ruc1);
            $sql->bindValue(10,$cargo1);
            $sql->bindValue(11,$firmante1);
            $sql->bindValue(12,$logo1);
            $sql->bindValue(13,$fech2);
            $sql->bindValue(14,$fech_final_2);
            $sql->bindValue(15,$tipo_2);
            $sql->bindValue(16,$ruc2);
            $sql->bindValue(17,$cargo2);
            $sql->bindValue(18,$firmante2);
            $sql->bindValue(19,$logo2);
            $sql->bindValue(20,$fech3);
            $sql->bindValue(21,$fech_final_3);
            $sql->bindValue(22,$tipo_3);
            $sql->bindValue(23,$ruc3);
            $sql->bindValue(24,$cargo3);
            $sql->bindValue(25,$firmante3);
            $sql->bindValue(26,$logo3);
            $sql->bindValue(27,$fech4);
            $sql->bindValue(28,$fech_final_4);
            $sql->bindValue(29,$tipo_4);
            $sql->bindValue(30,$ruc4);
            $sql->bindValue(31,$cargo4);
            $sql->bindValue(32,$firmante4);
            $sql->bindValue(33,$logo4);
            $sql->bindValue(34,$fech5);
            $sql->bindValue(35,$fech_final_5);
            $sql->bindValue(36,$tipo_5);
            $sql->bindValue(37,$ruc5);
            $sql->bindValue(38,$cargo5);
            $sql->bindValue(39,$firmante5);
            $sql->bindValue(40,$logo5);
            $sql->execute();

        }

        public function update_lista_pension($id_afiliado, $num_doc, $cantidad, $tipo, $fech_nac, 
                $fech1, $fech_final_1, $tipo_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $tipo_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $tipo_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $tipo_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $tipo_5, $ruc5, $cargo5, $firmante5, $logo5, $idpension)
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
            $sql->bindValue(4,$fech_nac);
            $sql->bindValue(5,$fech1);
            $sql->bindValue(6,$fech_final_1);
            $sql->bindValue(7,$tipo_1);
            $sql->bindValue(8,$ruc1);
            $sql->bindValue(9,$cargo1);
            $sql->bindValue(10,$firmante1);
            $sql->bindValue(11,$logo1);
            $sql->bindValue(12,$fech2);
            $sql->bindValue(13,$fech_final_2);
            $sql->bindValue(14,$tipo_2);
            $sql->bindValue(15,$ruc2);
            $sql->bindValue(16,$cargo2);
            $sql->bindValue(17,$firmante2);
            $sql->bindValue(18,$logo2);
            $sql->bindValue(19,$fech3);
            $sql->bindValue(20,$fech_final_3);
            $sql->bindValue(21,$tipo_3);
            $sql->bindValue(22,$ruc3);
            $sql->bindValue(23,$cargo3);
            $sql->bindValue(24,$firmante3);
            $sql->bindValue(25,$logo3);
            $sql->bindValue(26,$fech4);
            $sql->bindValue(27,$fech_final_4);
            $sql->bindValue(28,$tipo_4);
            $sql->bindValue(29,$ruc4);
            $sql->bindValue(30,$cargo4);
            $sql->bindValue(31,$firmante4);
            $sql->bindValue(32,$logo4);
            $sql->bindValue(33,$fech5);
            $sql->bindValue(34,$fech_final_5);
            $sql->bindValue(35,$tipo_5);
            $sql->bindValue(36,$ruc5);
            $sql->bindValue(37,$cargo5);
            $sql->bindValue(38,$firmante5);
            $sql->bindValue(39,$logo5);
            $sql->bindValue(40,$idpension);
            $sql->bindValue(41,$tipo);
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