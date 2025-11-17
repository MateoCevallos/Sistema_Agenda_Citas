<?php 

// En desarrollo es mejor ver los errores:
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once('../config/sesiones.php');
require_once('../models/citas.models.php');

$cita = new Cita_Model();

// Validamos que venga 'op' por GET
$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {

    case 'todos':
        $datos = $cita->todos();

        $todos = array(); // importante inicializar

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }

        echo json_encode($todos);
        break;

    case 'uno':
        // Validamos que venga el id de la cita
        if (isset($_POST['id_cita'])) {
            $id = intval($_POST['id_cita']);

            $datos = $cita->uno($id);
            $res = mysqli_fetch_assoc($datos);

            // Si no se encontró, devolvemos objeto vacío
            echo json_encode($res ? $res : array());
        } else {
            echo json_encode(array("error" => "Falta id_cita"));
        }
        break;

    case 'insertar':
        // Campos: id_perro, fecha_hora, servicio, estado, notas
        $id_perro    = intval($_POST['id_perro']);
        $fecha_hora  = $_POST['fecha_hora'];   // 'YYYY-MM-DD HH:MM:SS'
        $servicio    = $_POST['servicio'];
        // Si no envías estado, podrías poner 'pendiente' por defecto:
        $estado      = isset($_POST['estado']) ? $_POST['estado'] : 'pendiente';
        $notas       = $_POST['notas'];

        $datos = $cita->insertar(
            $id_perro,
            $fecha_hora,
            $servicio,
            $estado,
            $notas
        );

        echo json_encode($datos);
        break;

    case 'actualizar':
        $id          = intval($_POST['id_cita']);
        $id_perro    = intval($_POST['id_perro']);
        $fecha_hora  = $_POST['fecha_hora'];
        $servicio    = $_POST['servicio'];
        $estado      = $_POST['estado'];
        $notas       = $_POST['notas'];

        $datos = $cita->actualizar(
            $id,
            $id_perro,
            $fecha_hora,
            $servicio,
            $estado,
            $notas
        );

        echo json_encode($datos);
        break;

    case 'eliminar':
        $id = intval($_POST['id_cita']);

        $datos = $cita->eliminar($id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(array("error" => "Operación no válida"));
        break;
}
?>
