<?php 

// En desarrollo es mejor ver los errores:
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once('../config/sesiones.php');
require_once('../models/perros.models.php');

$perro = new Perro_Model();

// Validamos que venga 'op' por GET
$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {

    case 'todos':
        $datos = $perro->todos();

        $todos = array(); // importante inicializar

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }

        echo json_encode($todos);
        break;

    case 'uno':
        // Validamos que venga el id del perro
        if (isset($_POST['id_perro'])) {
            $id = intval($_POST['id_perro']);

            $datos = $perro->uno($id);
            $res = mysqli_fetch_assoc($datos);

            // Si no se encontró, devolvemos objeto vacío
            echo json_encode($res ? $res : array());
        } else {
            echo json_encode(array("error" => "Falta id_perro"));
        }
        break;

    case 'insertar':
        // Campos de la tabla perros:
        // id_dueno, nombre, raza, fecha_nacimiento, peso_kg, notas
        $id_dueno         = intval($_POST['id_dueno']);
        $nombre           = $_POST['nombre'];
        $raza             = $_POST['raza'];
        $fecha_nacimiento = $_POST['fecha_nacimiento']; // formato 'YYYY-MM-DD'
        $peso_kg          = $_POST['peso_kg'];
        $notas            = $_POST['notas'];

        $datos = $perro->insertar(
            $id_dueno,
            $nombre,
            $raza,
            $fecha_nacimiento,
            $peso_kg,
            $notas
        );

        echo json_encode($datos);
        break;

    case 'actualizar':
        $id               = intval($_POST['id_perro']);
        $id_dueno         = intval($_POST['id_dueno']);
        $nombre           = $_POST['nombre'];
        $raza             = $_POST['raza'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $peso_kg          = $_POST['peso_kg'];
        $notas            = $_POST['notas'];

        $datos = $perro->actualizar(
            $id,
            $id_dueno,
            $nombre,
            $raza,
            $fecha_nacimiento,
            $peso_kg,
            $notas
        );

        echo json_encode($datos);
        break;

    case 'eliminar':
        $id = intval($_POST['id_perro']);

        $datos = $perro->eliminar($id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(array("error" => "Operación no válida"));
        break;
}
?>
