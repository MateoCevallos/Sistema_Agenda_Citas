<?php
require_once('../config/conexion.php');

class Actividad_Model {

    public function todos() {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "SELECT * FROM actividades";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function uno($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "SELECT * FROM actividades WHERE id_actividad = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function insertar($nombre_actividad, $tipo_actividad, $fecha_actividad, $id_organizador) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id_organizador = intval($id_organizador);

        $cadena = "INSERT INTO actividades (nombre_actividad, tipo_actividad, fecha_actividad, id_organizador)
                   VALUES ('$nombre_actividad', '$tipo_actividad', '$fecha_actividad', $id_organizador)";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function actualizar($id, $nombre_actividad, $tipo_actividad, $fecha_actividad, $id_organizador) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $id_organizador = intval($id_organizador);

        $cadena = "UPDATE actividades 
                   SET nombre_actividad='$nombre_actividad',
                       tipo_actividad='$tipo_actividad',
                       fecha_actividad='$fecha_actividad',
                       id_organizador=$id_organizador
                   WHERE id_actividad = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function eliminar($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "DELETE FROM actividades WHERE id_actividad = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
}
