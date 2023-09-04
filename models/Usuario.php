<?php
    class Usuario extends Conectar {

        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT id, alias, nombres, apellidos, clave FROM usuarios WHERE est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_usuario_x_id($us_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuarios WHERE id= ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $us_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function loguear_usuario($alias, $clave) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuarios WHERE alias = ? AND clave = ? AND est = 1;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $alias);
            $sql->bindValue(2, $clave);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_usuario($us_alias, $us_nom, $us_ape, $us_pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO usuarios (id, alias, nombres, apellidos, clave, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, ?, ?, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$us_alias);
            $sql->bindValue(2,$us_nom);
            $sql->bindValue(3,$us_ape);
            $sql->bindValue(4,$us_pass);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() AS 'id'; ";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_usuario($us_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuarios
                SET
                    est=0,
                    fech_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$us_id);
            $sql->execute();

            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_usuario($us_id, $us_alias, $us_nom, $us_ape, $us_pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuarios
                SET
                    alias=?,
                    nombres=?,
                    apellidos=?,
                    clave = ?,
                    fech_modi = now()
                WHERE
                    id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$us_alias);
            $sql->bindValue(2,$us_nom);
            $sql->bindValue(3,$us_ape);
            $sql->bindValue(4,$us_pass);
            $sql->bindValue(5,$us_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }


        
    }
?>