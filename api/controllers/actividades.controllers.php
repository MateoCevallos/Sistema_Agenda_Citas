<?php

// En desarrollo es mejor ver los errores:
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once('../config/sesiones.php');
require_once('../models/actividades.models.php');

$actividad = new Actividad_Model();

// Validamos que venga 'op' por GET
$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {

    case 'todos':
        $datos = $actividad->todos();

        $todos = array(); // importante inicializar

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }

        echo json_encode($todos);
        break;

    case 'uno':
        // Validamos que venga el id
        if (isset($_POST['id_actividad'])) {
            $id = intval($_POST['id_actividad']);

            $datos = $actividad->uno($id);
            $res = mysqli_fetch_assoc($datos);

            // Si no se encontró, devolvemos objeto vacío
            echo json_encode($res ? $res : array());
        } else {
            echo json_encode(array("error" => "Falta id_actividad"));
        }
        break;

    case 'insertar':
        $nombre_actividad = $_POST['nombre_actividad'];
        $tipo_actividad   = $_POST['tipo_actividad'];
        $fecha_actividad  = $_POST['fecha_actividad']; // formato 'YYYY-MM-DD'
        $id_organizador   = intval($_POST['id_organizador']);

        $datos = $actividad->insertar(
            $nombre_actividad,
            $tipo_actividad,
            $fecha_actividad,
            $id_organizador
        );

        echo json_encode($datos);
        break;

    case 'actualizar':
        $id               = intval($_POST['id_actividad']);
        $nombre_actividad = $_POST['nombre_actividad'];
        $tipo_actividad   = $_POST['tipo_actividad'];
        $fecha_actividad  = $_POST['fecha_actividad'];
        $id_organizador   = intval($_POST['id_organizador']);

        $datos = $actividad->actualizar(
            $id,
            $nombre_actividad,
            $tipo_actividad,
            $fecha_actividad,
            $id_organizador
        );

        echo json_encode($datos);
        break;

    case 'eliminar':
        $id = intval($_POST['id_actividad']);

        $datos = $actividad->eliminar($id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(array("error" => "Operación no válida"));
        break;
}
?>
