
<?php
/* 
class Clase_Conectar{
    public $conexion;
    protected $db;
    private $host= 'localhost';
    private $uid = 'root';
    private $pwd='';
    private $database='sistema_cultural';

    public function Procedimiento_Conectar(){
        $this->conexion = mysqli_connect( $this->host,  $this->uid,  $this->pwd);
        mysqli_query($this->conexion,"SET NAMES utf8");
        if($this->conexion == 0){
            die("error al conectarse con mysql ". mysqli_error($this->conexion));
        }
        $this->db = mysqli_select_db($this->conexion, $this->database);
        if($this->db==0) die("error al conectar con la base de datos". mysql_error($this->conexion));

        return $this->conexion;
    }

} 
*/

class Clase_Conectar{
    public $conexion;
    protected $db;
    private $host= 'localhost';
    private $uid = 'root';
    private $pwd = '';
    private $database = 'sistema_cultural';

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

