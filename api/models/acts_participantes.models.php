<?php
require_once('../config/conexion.php');

class Actividad_Participante_Model {

    public function todos() {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        // Tabla intermedia Actividad_Participante
        $cadena = "SELECT * FROM actividad_participante";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function uno($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "SELECT * FROM actividad_participante WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function insertar($id_actividad, $id_participante) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id_actividad    = intval($id_actividad);
        $id_participante = intval($id_participante);

        $cadena = "INSERT INTO actividad_participante (id_actividad, id_participante)
                   VALUES ($id_actividad, $id_participante)";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function actualizar($id, $id_actividad, $id_participante) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id             = intval($id);
        $id_actividad   = intval($id_actividad);
        $id_participante = intval($id_participante);

        $cadena = "UPDATE actividad_participante 
                   SET id_actividad = $id_actividad,
                       id_participante = $id_participante
                   WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    public function eliminar($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "DELETE FROM actividad_participante WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
}
