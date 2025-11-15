<?php

// En desarrollo es mejor ver los errores:
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once('../config/sesiones.php');
require_once('../models/acts_participantes.models.php');

$act_part = new Actividad_Participante_Model();

// Validamos que venga 'op' por GET
$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {

    case 'todos':
        $datos = $act_part->todos();

        $todos = array(); // importante inicializar

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }

        echo json_encode($todos);
        break;

    case 'uno':
        // Validamos que venga el id
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);

            $datos = $act_part->uno($id);
            $res = mysqli_fetch_assoc($datos);

            // Si no se encontró, devolvemos objeto vacío
            echo json_encode($res ? $res : array());
        } else {
            echo json_encode(array("error" => "Falta id"));
        }
        break;

    case 'insertar':
        if (isset($_POST['id_actividad']) && isset($_POST['id_participante'])) {
            $id_actividad    = intval($_POST['id_actividad']);
            $id_participante = intval($_POST['id_participante']);

            $datos = $act_part->insertar($id_actividad, $id_participante);
            echo json_encode($datos);
        } else {
            echo json_encode(array("error" => "Faltan id_actividad o id_participante"));
        }
        break;

    case 'actualizar':
        if (isset($_POST['id']) && isset($_POST['id_actividad']) && isset($_POST['id_participante'])) {
            $id              = intval($_POST['id']);
            $id_actividad    = intval($_POST['id_actividad']);
            $id_participante = intval($_POST['id_participante']);

            $datos = $act_part->actualizar($id, $id_actividad, $id_participante);
            echo json_encode($datos);
        } else {
            echo json_encode(array("error" => "Faltan parámetros para actualizar"));
        }
        break;

    case 'eliminar':
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);

            $datos = $act_part->eliminar($id);
            echo json_encode($datos);
        } else {
            echo json_encode(array("error" => "Falta id para eliminar"));
        }
        break;

    default:
        echo json_encode(array("error" => "Operación no válida"));
        break;
}
?>
