<?php
  class Conexion {
    protected $conexionBD;

    public function __construct() {
      try {
        $this->conexionBD = new PDO("mysql:host=localhost;dbname=spacex","root","");
      } catch(Exception $e) {
        echo "No se ha podido conectar a la Base de Datos. "
             . "ERROR: " . $e->getMessage();
      }
    }

    public function __destruct() {
      $this->conexionBD = NULL;
    }

    public function __conexion() {
      return $this->conexionBD;
    }
  }
