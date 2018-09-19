<?php

class RepositorioSocio {
    
    public static function insertar_socio($conexion,$socio) {
        $socio_insertado = false;
        
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO socio(nombre,apellido,mail,clave,fecha_registro) VALUES (:nombre,:apellido,:mail,:clave,NOW())";
                
                $sentencia = $conexion->prepare($sql);
                
                $nombre = $socio->getNombre();
                $apellido = $socio->getApellido();
                $mail = $socio->getMail();
                $clave = $socio->getClave();
                
                $sentencia->bindParam(':nombre',$nombre,PDO::PARAM_STR);
                $sentencia->bindParam(':apellido',$apellido,PDO::PARAM_STR);
                $sentencia->bindParam(':mail',$mail,PDO::PARAM_STR);
                $sentencia->bindParam(':clave',$clave,PDO::PARAM_STR);
                
                $socio_insertado = $sentencia->execute();
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $socio_insertado;
    }
    
    public static function mail_existe($conexion, $mail) {
        //Vamos a buscar en la bd cualquier email que tenga ese nombre.
        $mail_existe = false;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT mail FROM socio WHERE mail = :mail";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':mail',$mail,PDO::PARAM_STR);
                
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                
                if (count($resultado)){ //cualquier resultado !=0 es verdadero
                    $mail_existe = true;
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        
        return $mail_existe;
    }
    
    public static function obtener_socio_por_mail($conexion,$mail) {
        $socio = null;
        
        if (isset($conexion)) {
            try {
                include_once 'Socio.inc.php';
                
                $sql = "SELECT * FROM socio WHERE mail = :mail";
                $sentencia = $conexion->prepare($sql);
                $sentencia-> bindParam(':mail',$mail,PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch(); //no hace falta fetchall, xq dara un unico resultado
                
                if (!empty($resultado)){
//$socios[] = new Usuario($id,$nombre,$apellido,$direccion,$telefono,$mail,$clave,$fecha_registro)                    
                    $socio = new Socio($resultado['id'],
                            $resultado['nombre'],
                            $resultado['apellido'],
                            $resultado['direccion'],
                            $resultado['telefono'],
                            $resultado['mail'],
                            $resultado['clave'],
                            $resultado['fecha_registro']);
                }
                
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        
        return $socio;
    }
}
