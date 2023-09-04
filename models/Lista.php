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
                $fech1, $fech_final_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $ruc5, $cargo5, $firmante5, $logo5)
            {

            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lista(id, id_afiliado, num_doc, cantidad, tipo, fech_nac, 
                fech1, fech_final_1, ruc1, cargo1, firmante1, logo1, 
                fech2, fech_final_2, ruc2, cargo2, firmante2, logo2, 
                fech3, fech_final_3, ruc3, cargo3, firmante3, logo3, 
                fech4, fech_final_4, ruc4, cargo4, firmante4, logo4, 
                fech5, fech_final_5, ruc5, cargo5, firmante5, logo5, fech_crea, fech_modi, fech_elim, estado) VALUES (
                  NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_afiliado);
            $sql->bindValue(2,$num_doc);
            $sql->bindValue(3,$cantidad);
            $sql->bindValue(4,$tipo);
            $sql->bindValue(5,$fech_nac);
            $sql->bindValue(6,$fech1);
            $sql->bindValue(7,$fech_final_1);
            $sql->bindValue(8,$ruc1);
            $sql->bindValue(9,$cargo1);
            $sql->bindValue(10,$firmante1);
            $sql->bindValue(11,$logo1);
            $sql->bindValue(12,$fech2);
            $sql->bindValue(13,$fech_final_2);
            $sql->bindValue(14,$ruc2);
            $sql->bindValue(15,$cargo2);
            $sql->bindValue(16,$firmante2);
            $sql->bindValue(17,$logo2);
            $sql->bindValue(18,$fech3);
            $sql->bindValue(19,$fech_final_3);
            $sql->bindValue(20,$ruc3);
            $sql->bindValue(21,$cargo3);
            $sql->bindValue(22,$firmante3);
            $sql->bindValue(23,$logo3);
            $sql->bindValue(24,$fech4);
            $sql->bindValue(25,$fech_final_4);
            $sql->bindValue(26,$ruc4);
            $sql->bindValue(27,$cargo4);
            $sql->bindValue(28,$firmante4);
            $sql->bindValue(29,$logo4);
            $sql->bindValue(30,$fech5);
            $sql->bindValue(31,$fech_final_5);
            $sql->bindValue(32,$ruc5);
            $sql->bindValue(33,$cargo5);
            $sql->bindValue(34,$firmante5);
            $sql->bindValue(35,$logo5);
            $sql->execute();

        }

        public function update_lista_pension($id_afiliado, $num_doc, $cantidad, $tipo, $fech_nac, 
                $fech1, $fech_final_1, $ruc1, $cargo1, $firmante1, $logo1,
                $fech2, $fech_final_2, $ruc2, $cargo2, $firmante2, $logo2,
                $fech3, $fech_final_3, $ruc3, $cargo3, $firmante3, $logo3,
                $fech4, $fech_final_4, $ruc4, $cargo4, $firmante4, $logo4,
                $fech5, $fech_final_5, $ruc5, $cargo5, $firmante5, $logo5, $idpension)
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
            $sql->bindValue(4,$fech_nac);
            $sql->bindValue(5,$fech1);
            $sql->bindValue(6,$fech_final_1);
            $sql->bindValue(7,$ruc1);
            $sql->bindValue(8,$cargo1);
            $sql->bindValue(9,$firmante1);
            $sql->bindValue(10,$logo1);
            $sql->bindValue(11,$fech2);
            $sql->bindValue(12,$fech_final_2);
            $sql->bindValue(13,$ruc2);
            $sql->bindValue(14,$cargo2);
            $sql->bindValue(15,$firmante2);
            $sql->bindValue(16,$logo2);
            $sql->bindValue(17,$fech3);
            $sql->bindValue(18,$fech_final_3);
            $sql->bindValue(19,$ruc3);
            $sql->bindValue(20,$cargo3);
            $sql->bindValue(21,$firmante3);
            $sql->bindValue(22,$logo3);
            $sql->bindValue(23,$fech4);
            $sql->bindValue(24,$fech_final_4);
            $sql->bindValue(25,$ruc4);
            $sql->bindValue(26,$cargo4);
            $sql->bindValue(27,$firmante4);
            $sql->bindValue(28,$logo4);
            $sql->bindValue(29,$fech5);
            $sql->bindValue(30,$fech_final_5);
            $sql->bindValue(31,$ruc5);
            $sql->bindValue(32,$cargo5);
            $sql->bindValue(33,$firmante5);
            $sql->bindValue(34,$logo5);
            $sql->bindValue(35,$idpension);
            $sql->bindValue(36,$tipo);
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