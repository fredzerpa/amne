<?php

require_once('../../config/conexion.php');

class User extends Conexion
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($cedula, $nombre, $apellidos, $telefono, $email, $direccion, $clave, $nivel)
  {

    $query = "INSERT INTO usuarios (Cedula, Nombre, Apellidos, Telefono, Email, Direccion, Clave, Nivel)
                VALUES (:cedula, :name, :lastname, :phone, :email, :address, :password, :level)";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":cedula" => $cedula, ":name" => $nombre, ":lastname" => $apellidos, ":phone" => $telefono, ":email" => $email, ":address" => $direccion, ":password" => $clave, ":level" => $nivel
    ));
    
    $_SESSION['notification'] = true;
    $_SESSION['notification_title'] = 'Crear Usuario';
    $_SESSION['notification_message'] = 'Se ha creado el usuario satisfactoriamente.';
    return header('location: ../../views/admin/users.php?action=create&success=true');
  }

  public function read($id = "")
  {

    if ($id != "") {
      $query = "SELECT Id, Nombre, Apellidos, Cedula, Telefono, Email, Direccion, Nivel FROM usuarios WHERE Id = :account_id";

      $resultado = $this->conexionBD->prepare($query);

      $resultado->execute(array(":account_id" => $id));

      return $resultado->fetch();
    }

    $query = "SELECT Id, Nombre, Apellidos, Cedula, Telefono, Email, Direccion, Nivel FROM usuarios";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  public function update($id, $cedula, $nombre, $apellidos, $telefono, $email, $direccion, $clave = "", $nivel)
  {
    if ($clave != "") {
      $query = "UPDATE usuarios SET Cedula = :cedula, Nombre = :name, Apellidos = :lastname, Telefono = :phone, Email = :email, Direccion = :address, Clave = :password, Nivel = :level WHERE Id = :account_id";

      $resultado = $this->conexionBD->prepare($query);

      $resultado->execute(array(
        ":account_id" => $id,
        ":name" => $nombre,
        ":lastname" => $apellidos,
        ":cedula" => $cedula,
        ":phone" => $telefono,
        ":email" => $email,
        ":address" => $direccion,
        ":password" => $clave,
        ":level" => $nivel
      ));

      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Actualizar Usuario';
      $_SESSION['notification_message'] = 'Se ha actualizado el usuario satisfactoriamente.';
      return header('location: ../../views/admin/users.php?action=update&id=' . $id . '&success=true');
    }

    $query = "UPDATE usuarios SET Cedula = :cedula, Nombre = :name, Apellidos = :lastname, Telefono = :phone, Email = :email, Direccion = :address, Nivel = :level WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":account_id" => $id,
      ":name" => $nombre,
      ":lastname" => $apellidos,
      ":cedula" => $cedula,
      ":phone" => $telefono,
      ":email" => $email,
      ":address" => $direccion,
      ":level" => $nivel
    ));

    $_SESSION['notification'] = true;
    $_SESSION['notification_title'] = 'Actualizar Usuario';
    $_SESSION['notification_message'] = 'Se ha actualizado el usuario satisfactoriamente.';
    return header('location: ../../views/admin/users.php?action=update&id=' . $id . '&success=true');
  }

  public function delete($id)
  {

    $query = "DELETE FROM usuarios WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":account_id" => $id));

    $_SESSION['notification'] = true;
    $_SESSION['notification_title'] = 'Eliminar Usuario';
    $_SESSION['notification_message'] = 'Se ha eliminado el usuario satisfactoriamente.';
    return header('location: ../../views/staff/data-display.php?table=usuarios&success=true');
  }

  public function updateRegular($id, $cedula, $nombre, $apellidos, $telefono, $email, $direccion)
  {

    $query = "UPDATE usuarios SET Nombre = :name, Apellidos = :lastname, Telefono = :phone, Email = :email, address = :address WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":account_id" => $id, ":name" => $nombre, ":lastname" => $apellidos, ":email" => $email, ":address" => $direccion, ":username" => $cedula, ":phone" => $telefono
    ));

    return header('location: ../../views/cms/cms.php?success=true');
  }
}
