<?php
require_once('../config/conexion.php');

class Participante_Model {

    public function todos() {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "SELECT * FROM participantes";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function uno($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "SELECT * FROM participantes WHERE id_participante = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function insertar($nombre, $correo, $telefono) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "INSERT INTO participantes (nombre, correo, telefono)
                   VALUES ('$nombre', '$correo', '$telefono')";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function actualizar($id, $nombre, $correo, $telefono) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "UPDATE participantes 
                   SET nombre='$nombre', correo='$correo', telefono='$telefono'
                   WHERE id_participante = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function eliminar($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "DELETE FROM participantes WHERE id_participante = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
}