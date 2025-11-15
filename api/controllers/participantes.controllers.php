<?php

// En desarrollo es mejor ver los errores:
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once('../config/sesiones.php');
require_once('../models/participantes.models.php');

$participante = new Participante_Model();

// Validamos que venga 'op' por GET
$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {

    // LISTAR TODOS
    case 'todos':
        $datos = $participante->todos();

        $todos = array(); // importante inicializar

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }

        echo json_encode($todos);
        break;

    // OBTENER UNO
    case 'uno':
        if (isset($_POST['id_participante'])) {
            $id = intval($_POST['id_participante']);

            $datos = $participante->uno($id);
            $res = mysqli_fetch_assoc($datos);

            echo json_encode($res ? $res : array());
        } else {
            echo json_encode(array("error" => "Falta id_participante"));
        }
        break;

    // INSERTAR
    case 'insertar':
        $nombre   = $_POST['nombre'];
        $correo   = $_POST['correo'];
        $telefono = $_POST['telefono'];

        $datos = $participante->insertar($nombre, $correo, $telefono);
        echo json_encode($datos);
        break;

    // ACTUALIZAR
    case 'actualizar':
        $id       = intval($_POST['id_participante']);
        $nombre   = $_POST['nombre'];
        $correo   = $_POST['correo'];
        $telefono = $_POST['telefono'];

        $datos = $participante->actualizar($id, $nombre, $correo, $telefono);
        echo json_encode($datos);
        break;

    // ELIMINAR
    case 'eliminar':
        $id = intval($_POST['id_participante']);

        $datos = $participante->eliminar($id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(array("error" => "Operación no válida"));
        break;
}
?>
