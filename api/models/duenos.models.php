<?php
require_once('../config/conexion.php');

class Dueno_Model {

    // Obtener todos los dueños
    public function todos() {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "SELECT * FROM duenos";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos; // resultset
    }

    // Obtener un dueño por id
    public function uno($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "SELECT * FROM duenos WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    // Insertar un nuevo dueño
    public function insertar($nombre, $apellido, $telefono, $email, $direccion) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $cadena = "INSERT INTO duenos (nombre, apellido, telefono, email, direccion)
                   VALUES ('$nombre', '$apellido', '$telefono', '$email', '$direccion')";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos; // true/false
    }

    // Actualizar un dueño
    public function actualizar($id, $nombre, $apellido, $telefono, $email, $direccion) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);

        $cadena = "UPDATE duenos 
                   SET nombre='$nombre',
                       apellido='$apellido',
                       telefono='$telefono',
                       email='$email',
                       direccion='$direccion'
                   WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    // Eliminar un dueño
    public function eliminar($id) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id = intval($id);
        $cadena = "DELETE FROM duenos WHERE id = $id";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
}
?>