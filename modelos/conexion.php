<?php
 //include_once '../assets/adodb5/adodb.inc.php';

class Conexion{
    private $DBType = 'mysqli';
    private $DBServer = 'localhost'; // server name or IP address
    private $DBUser = 'chofist';
    private $DBPass = '1234';
    private $DBName = 'pytcatalogo';

    public function __construct(){}
    
    public function conectar(){
        $con = ADONewConnection($this->DBType);
        $con->debug = false;
        $con->connect($this->DBServer,$this->DBUser,$this->DBPass,$this->DBName);
        return $con;
    }
}
?>