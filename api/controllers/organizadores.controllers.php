<?php
/*
error_reporting(0);
require_once('../config/sesiones.php');
require_once("../models/organizadores.models.php");

//cambiar roles por organizadores
$organizador = new Organizador_Model;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $organizador->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $id_organizador = $_POST["id_organizador"];
        $datos = array();
        $datos = $organizador->uno($id_organizador);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
}
*/

// En desarrollo es mejor ver los errores:

error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once('../config/sesiones.php');
require_once('../models/organizadores.models.php');

$organizador = new Organizador_Model();

// Validamos que venga 'op' por GET
$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {

    case 'todos':
        $datos = $organizador->todos();

        $todos = array(); // <- importante inicializar

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }

        echo json_encode($todos);
        break;

    case 'uno':
        // Validamos que venga el id
        if (isset($_POST['id_organizador'])) {
            $id = intval($_POST['id_organizador']);

            $datos = $organizador->uno($id);
            $res = mysqli_fetch_assoc($datos);

            // Si no se encontró, devolvemos objeto vacío
            echo json_encode($res ? $res : array());
        } else {
            echo json_encode(array("error" => "Falta id_organizador"));
        }
        break;
    case "insertar":
        $nombre=$_POST["nombre"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];

        $datos = array();
        $datos = $organizador->insertar($nombre, $correo, $telefono);
        echo json_encode($datos);
        break;
    case "actualizar":
        $id = $_POST["id_organizador"];

        $nombre=$_POST["nombre"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];

        $datos = array();
        $datos = $organizador->actualizar($id, $nombre, $correo, $telefono);
        echo json_encode($datos);
        break;
    case "eliminar":
        $id = $_POST["id_organizador"];
        $datos = array();
        $datos = $organizador->eliminar($id);
        echo json_encode($datos);
        break;
    default:
        echo json_encode(array("error" => "Operación no válida"));
        break;
}
?>
