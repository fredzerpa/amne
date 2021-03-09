<?php

require_once('../config/conexion.php');
require_once('../utils/functions.php');

class Auth extends Conexion
{
  protected $user;
  protected $pass;

  public function __construct()
  {
    parent::__construct();

    $this->user = clean(filter_input(INPUT_POST, "username"));
    $this->pass = clean(filter_input(INPUT_POST, "password"));
  }

  private function checkUser()
  {
    $query = "SELECT * FROM usuarios WHERE Cedula = :username";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":username" => $this->user));

    return $resultado->rowCount();
  }

  private function checkPassword()
  {
    $query = "SELECT * FROM usuarios WHERE Cedula = :username";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":username" => $this->user));

    $password = $resultado->fetch();
    
    $pass_tmp = $password['Clave'];
    
    return password_verify($this->pass, $pass_tmp);
  }

  public function login()
  {
    return ($this->checkUser() != 0 && $this->checkPassword());
  }

  public function getUsuario()
  {

    return $this->user;
  }

  public function getAccountId()
  {

    $query = "SELECT * FROM usuarios WHERE Cedula = :username";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":username" => $this->user));

    $usuario = $resultado->fetch();

    return $usuario['Id'];
  }

  public function getRole()
  {

    $query = "SELECT * FROM usuarios WHERE Cedula = :username";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":username" => $this->user));

    $usuario = $resultado->fetch();

    return $usuario['Nivel'];
  }
}
