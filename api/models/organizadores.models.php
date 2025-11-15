<?php
/*
require_once('../config/conexion.php');
class Organizador_Model{
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `organizadores`";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * From organizadores where id_organizador = $id";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
}
*/

require_once('../config/conexion.php');

class Organizador_Model {

    public function todos() {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "SELECT * FROM organizadores";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function uno($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "SELECT * FROM organizadores WHERE id_organizador = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function insertar($nombre, $correo, $telefono) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "INSERT INTO organizadores (nombre, correo, telefono)
                   VALUES ('$nombre', '$correo', '$telefono')";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function actualizar($id, $nombre, $correo, $telefono) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "UPDATE organizadores 
                   SET nombre='$nombre', correo='$correo', telefono='$telefono'
                   WHERE id_organizador = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function eliminar($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "DELETE FROM organizadores WHERE id_organizador = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
    /*
    public function login1($email, $contrasenia){
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "select * from usuarios where email='$email' and contrasenia='$contrasenia'";
        $datos = mysqli_query($con,$cadena);
        $con->close();
        return $datos;
    }
    public function login2($email){
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "select * from usuarios where email='$email'";
        $datos = mysqli_query($con,$cadena);
        $con->close();
        return $datos;
    }
    */
}
