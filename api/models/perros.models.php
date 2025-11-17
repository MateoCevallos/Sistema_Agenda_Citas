<?php
require_once('../config/conexion.php');

class Perro_Model {

    // Obtener todos los perros
    public function todos() {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "SELECT * FROM perros";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos; // resultset
    }

    // Obtener un perro por id
    public function uno($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "SELECT * FROM perros WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    // Insertar un nuevo perro
    public function insertar($id_dueno, $nombre, $raza, $fecha_nacimiento, $peso_kg, $notas) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id_dueno   = intval($id_dueno);
        $peso_kg    = floatval($peso_kg); // decimal

        $cadena = "INSERT INTO perros (id_dueno, nombre, raza, fecha_nacimiento, peso_kg, notas)
                   VALUES ($id_dueno, '$nombre', '$raza', '$fecha_nacimiento', $peso_kg, '$notas')";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos; // true/false
    }

    // Actualizar un perro
    public function actualizar($id, $id_dueno, $nombre, $raza, $fecha_nacimiento, $peso_kg, $notas) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id        = intval($id);
        $id_dueno  = intval($id_dueno);
        $peso_kg   = floatval($peso_kg);

        $cadena = "UPDATE perros 
                   SET id_dueno = $id_dueno,
                       nombre = '$nombre',
                       raza = '$raza',
                       fecha_nacimiento = '$fecha_nacimiento',
                       peso_kg = $peso_kg,
                       notas = '$notas'
                   WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    // Eliminar un perro
    public function eliminar($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "DELETE FROM perros WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
}
?>
