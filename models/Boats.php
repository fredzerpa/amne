<?php
require_once('../../config/conexion.php');

class Boat extends Conexion
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($nombre, $codigo, $titular, $cant_tripulantes, $capacidad_carga)
  {

    $query = "INSERT INTO barcos (Nombre, Codigo, Titular, Cantidad_Tripulantes, Capacidad_Carga) VALUES (:name, :code, :owner, :crew_quantity, :load_quantity)";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ':name' => $nombre,
      ':code' => $codigo,
      ':owner' => $titular,
      ':crew_quantity' => $cant_tripulantes,
      ':load_quantity' => $capacidad_carga
    ));

    return header('location: ../../views/staff/data-display.php?table=barcos&success=true');
  }

  public function read($id = "")
  {

    if ($id != "") {
      $query = "SELECT * FROM barcos WHERE Id = :account_id";

      $resultado = $this->conexionBD->prepare($query);

      $resultado->execute(array(":account_id" => $id));

      return $resultado->fetch();
    }

    $query = "SELECT * FROM barcos";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  public function update($id, $nombre, $codigo, $titular, $cant_tripulantes, $capacidad_carga)
  {

    $query = "UPDATE barcos SET Nombre = :name, Codigo = :code, Titular = :owner, Cantidad_Tripulantes = :crew_quantity, Capacidad_Carga = :load_quantity WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":account_id" => $id,
      ':name' => $nombre,
      ':code' => $codigo,
      ':owner' => $titular,
      ':crew_quantity' => $cant_tripulantes,
      ':load_quantity' => $capacidad_carga
    ));

    return header('location: ../../views/staff/data-display.php?table=barcos&success=true');
  }

  public function delete($id)
  {

    $query = "DELETE FROM barcos WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":account_id" => $id));

    return header('location: ../../views/staff/data-display.php?table=barcos&success=true');
  }

  public function getLatest()
  {
    $query = "SELECT * FROM barcos ORDER BY Id DESC LIMIT 1;";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }
}
