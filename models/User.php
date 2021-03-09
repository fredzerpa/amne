<?php
require_once($_SERVER['DOCUMENT_ROOT'] . 'config/conexion.php');

class User extends Conexion
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($cedula, $nombre, $apellidos, $telefono, $email, $direccion, $clave, $nivel)
  {

    $query = "INSERT INTO users (Cedula, Nombre, Apellido, Telefono, Email, Direccion, Clave, Nivel)
                VALUES (:cedula, :name, :lastname, :phone, :email, :address, :password, :level)";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":cedula" => $cedula, ":name" => $nombre, ":lastname" => $apellidos, ":phone" => $telefono, ":email" => $email, ":address" => $direccion, ":password" => $clave, ":level" => $nivel
    ));

    return header('location: ../views/admin/users/users.php?success=true');
  }

  public function read($id = "")
  {

    if ($id != "") {
      $query = "SELECT * FROM users WHERE account_id = :account_id";

      $resultado = $this->conexionBD->prepare($query);

      $resultado->execute(array(":account_id" => $id));

      return $resultado->fetch();
    }

    $query = "SELECT * FROM users";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  public function update($id, $cedula, $nombre, $apellidos, $telefono, $email, $direccion, $nivel)
  {

    $query = "UPDATE usuarios SET Cedula = :cedula, Nombre = :name, Apellidos = :lastName, Telefono = :phone, Email = :email, Direccion = :address, Nivel = :level WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":name" => $nombre,
      ":lastName" => $apellidos,
      ":cedula" => $cedula,
      ":phone" => $telefono, 
      ":email" => $email,
      ":address" => $direccion,
      ":level" => $nivel, 
      ":account_id" => $id
    ));

    return header('location: ../views/admin/users/users.php?success=true');
  }

  public function delete($id)
  {

    $query = "DELETE FROM usuarios WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":account_id" => $id));

    return header('location: ../views/admin/users/users.php?success=true');
  }

  public function updateRegular($id, $cedula, $nombre, $apellidos, $telefono, $email, $direccion)
  {

    $query = "UPDATE usuarios SET Nombre = :name, Apellidos = :lastName, Email = :email, 
                address = :address WHERE account_id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":name" => $nombre, ":email" => $email,
      ":address" => $direccion, ":account_id" => $id
    ));

    return header('location: ../views/regular/home/home.php?success=true');
  }
}
