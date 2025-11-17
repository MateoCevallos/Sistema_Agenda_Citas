<?php

class Clase_Conectar{
    public $conexion;
    protected $db;
    private $host= 'localhost';
    private $uid = 'root';
    private $pwd = '';    private $database = 'salon_belleza_perros';

    public function Procedimiento_Conectar(){
        
        // Conexión al servidor MySQL
        $this->conexion = mysqli_connect($this->host, $this->uid, $this->pwd);
        mysqli_query($this->conexion, "SET NAMES utf8");

        if(!$this->conexion){
            die("Error al conectarse con MySQL: " . mysqli_error($this->conexion));
        }

        // Seleccionar la base de datos
        $this->db = mysqli_select_db($this->conexion, $this->database);

        if(!$this->db){
            die("Error al conectar con la base de datos: " . mysqli_error($this->conexion));
        }

        return $this->conexion;
    }
}
?>

