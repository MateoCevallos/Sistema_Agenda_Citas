<?php 

// En desarrollo es mejor ver los errores:
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once('../config/sesiones.php');
require_once('../models/duenos.models.php');

$dueno = new Dueno_Model();

// Validamos que venga 'op' por GET
$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {

    case 'todos':
        $datos = $dueno->todos();

        $todos = array(); // importante inicializar

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }

        echo json_encode($todos);
        break;

    case 'uno':
        // Validamos que venga el id del dueño
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);

            $datos = $dueno->uno($id);
            $res = mysqli_fetch_assoc($datos);

            // Si no se encontró, devolvemos objeto vacío
            echo json_encode($res ? $res : array());
        } else {
            echo json_encode(array("error" => "Falta id"));
        }
        break;

    case 'insertar':
        // Campos de la tabla duenos: nombre, apellido, telefono, email, direccion
        $nombre    = $_POST['nombre'];
        $apellido  = $_POST['apellido'];
        $telefono  = $_POST['telefono'];
        $email     = $_POST['email'];
        $direccion = $_POST['direccion'];

        $datos = $dueno->insertar(
            $nombre,
            $apellido,
            $telefono,
            $email,
            $direccion
        );

        echo json_encode($datos);
        break;

    case 'actualizar':
        $id        = intval($_POST['id']);
        $nombre    = $_POST['nombre'];
        $apellido  = $_POST['apellido'];
        $telefono  = $_POST['telefono'];
        $email     = $_POST['email'];
        $direccion = $_POST['direccion'];

        $datos = $dueno->actualizar(
            $id,
            $nombre,
            $apellido,
            $telefono,
            $email,
            $direccion
        );

        echo json_encode($datos);
        break;

    case 'eliminar':
        $id = intval($_POST['id']);

        $datos = $dueno->eliminar($id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(array("error" => "Operación no válida"));
        break;
}
?>
