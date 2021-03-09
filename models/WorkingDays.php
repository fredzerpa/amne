<?php
require_once('../../config/conexion.php');

class WorkingDay extends Conexion
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($fecha, $hora_inicio, $hora_cierre, $clima, $precio)
  {

    $query = "INSERT INTO jornadas (Fecha, Hora_Inicio, Hora_Cierre, Clima, Precio) VALUES (:date, :time_start, :time_end, :weather, :price)";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":date" => $fecha, ":time_start" => $hora_inicio, ":time_end" => $hora_cierre, ":weather" => $clima, ":price" => $precio
    ));

    return header('location: ../../views/staff/data-display.php?table=jornadas&success=true');
  }

  public function read($id = "")
  {

    if ($id != "") {
      $query = "SELECT Id, Fecha, TIME_FORMAT(Hora_Inicio, '%r') AS 'Hora de Inicio', TIME_FORMAT(Hora_Cierre, '%r') AS 'Hora de Cierre', Clima, Precio FROM jornadas WHERE Id = :account_id";

      $resultado = $this->conexionBD->prepare($query);

      $resultado->execute(array(":account_id" => $id));

      return $resultado->fetch();
    }

    $query = "SELECT Id, Fecha, TIME_FORMAT(Hora_Inicio, '%r') AS 'Hora de Inicio', TIME_FORMAT(Hora_Cierre, '%r') AS 'Hora de Cierre', Clima, Precio FROM jornadas ORDER BY Fecha DESC, Hora_Cierre ASC";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  public function readDefault($id = "")
  {

    if ($id != "") {
      $query = "SELECT Id, Fecha, Hora_Inicio, Hora_Cierre, Clima, Precio FROM jornadas WHERE Id = :account_id";

      $resultado = $this->conexionBD->prepare($query);

      $resultado->execute(array(":account_id" => $id));

      return $resultado->fetch();
    }

    $query = "SELECT Id, Fecha, Hora_Inicio, Hora_Cierre, Clima, Precio FROM jornadas ORDER BY Fecha DESC, Hora_Cierre ASC";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  public function update($id, $fecha, $hora_inicio, $hora_cierre, $clima, $precio)
  {

    $query = "UPDATE jornadas SET Fecha = :date, Hora_Inicio = :time_start, Hora_Cierre = :time_end, Clima = :weather, Precio = :price WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":account_id" => $id,
      ":date" => $fecha,
      ":time_start" => $hora_inicio,
      ":time_end" => $hora_cierre,
      ":weather" => $clima,
      ":price" => $precio
    ));

    return header('location: ../../views/staff/data-display.php?table=jornadas&success=true');
  }

  public function delete($id)
  {

    $query = "DELETE FROM jornadas WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":account_id" => $id));

    return header('location: ../../views/staff/data-display.php?table=jornadas&success=true');
  }

  public function getActive()
  {
    $query = "SELECT * FROM jornadas WHERE Fecha = CURRENT_DATE() AND Hora_Cierre > CURRENT_TIME() ORDER BY Hora_Cierre ASC";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  // public function readDefault($id = "")
  // {
  //   if ($id != "") {
  //     $query = "SELECT Id, Fecha, Hora_Inicio, Hora_Cierre, Clima, Precio FROM jornadas WHERE Id = :account_id";

  //     $resultado = $this->conexionBD->prepare($query);

  //     $resultado->execute(array(":account_id" => $id));

  //     return $resultado->fetch();
  //   }

  //   $query = "SELECT Id, Fecha, Hora_Inicio, Hora_Cierre, Clima, Precio FROM jornadas ORDER BY Fecha DESC, Hora_Cierre ASC";

  //   $resultado = $this->conexionBD->prepare($query);

  //   $resultado->execute();

  //   return $resultado->fetchAll();
  // }
}
