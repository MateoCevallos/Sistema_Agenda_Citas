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
    public function uno($id_dueno) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id_dueno = intval($id_dueno);
        $cadena = "SELECT * FROM duenos WHERE id = $id_dueno";
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
    public function actualizar($id_dueno, $nombre, $apellido, $telefono, $email, $direccion) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id_dueno = intval($id_dueno);

        $cadena = "UPDATE duenos 
                   SET nombre='$nombre',
                       apellido='$apellido',
                       telefono='$telefono',
                       email='$email',
                       direccion='$direccion'
                   WHERE id = $id_dueno";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }

    // Eliminar un dueño
    public function eliminar($id_dueno) {
        $con = new Clase_Conectar();
        $conexion = $con->Procedimiento_Conectar();

        $id_dueno = intval($id_dueno);
        $cadena = "DELETE FROM duenos WHERE id = $id_dueno";
        $datos = mysqli_query($conexion, $cadena);

        $con->conexion->close();
        return $datos;
    }
}
?>