<?php
require_once('../config/conexion.php');

class Cita_Model {

    // Obtener todas las citas
    public function todos() {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "SELECT * FROM citas";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos; // resultset
    }

    // Obtener una cita por id
    public function uno($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "SELECT * FROM citas WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    // Insertar una nueva cita
    // Campos: id_perro, fecha_hora (YYYY-MM-DD HH:MM:SS), servicio, estado, notas
    public function insertar($id_perro, $fecha_hora, $servicio, $estado, $notas) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id_perro = intval($id_perro);

        $cadena = "INSERT INTO citas (id_perro, fecha_hora, servicio, estado, notas)
                   VALUES ($id_perro, '$fecha_hora', '$servicio', '$estado', '$notas')";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos; // true/false
    }

    // Actualizar una cita
    public function actualizar($id, $id_perro, $fecha_hora, $servicio, $estado, $notas) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id       = intval($id);
        $id_perro = intval($id_perro);

        $cadena = "UPDATE citas 
                   SET id_perro = $id_perro,
                       fecha_hora = '$fecha_hora',
                       servicio = '$servicio',
                       estado = '$estado',
                       notas = '$notas'
                   WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    // Eliminar una cita
    public function eliminar($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "DELETE FROM citas WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
}
?>
