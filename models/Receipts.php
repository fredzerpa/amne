<?php
require_once('../../config/conexion.php');

class Receipt extends Conexion
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($codigo, $jornada_id, $usuario_id, $barco_id, $fecha, $hora, $mercancia_recibida, $ganancia_bruta, $gastos_operativos, $ganancia_neta)
  {

    $query = "INSERT INTO facturas (Codigo, Jornada_Id, Usuario_Id, Barco_Id, Fecha, Hora, Mercancia_Recibida, Ganancia_Bruta, Gastos_Operativos, Ganancia_Neta) VALUES (:code, :working_day_id, :user_id, :boat_id, :date, :time, :commodity_received, :brute_worth, :operating_expenses, :net_worth)";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ':code' => $codigo,
      ':working_day_id' => $jornada_id,
      ':user_id' => $usuario_id,
      ':boat_id' => $barco_id,
      ':date' => $fecha,
      ':time' => $hora,
      ':commodity_received' => $mercancia_recibida,
      ':brute_worth' => $ganancia_bruta,
      ':operating_expenses' => $gastos_operativos,
      ':net_worth' => $ganancia_neta
    ));

    return header('location: ../../views/staff/data-display.php?table=facturas&success=true');
  }

  public function read($id = "")
  {

    if ($id != "") {
      $query = "SELECT f.Id, f.Codigo, j.Fecha AS Jornada, CONCAT(u.Nombre, ' ', u.Apellidos) AS Cajero, b.Nombre AS Embarcacion, f.Mercancia_Recibida AS 'Mercancia Recibida (Kg)', f.Ganancia_Bruta AS 'Ganancia Bruta', f.Gastos_Operativos AS 'Gastos Operativos', f.Ganancia_Neta AS 'Ganancia Neta', f.Fecha, TIME_FORMAT(f.Hora, '%r') AS Hora FROM facturas AS f INNER JOIN jornadas AS j ON f.Jornada_Id = j.Id INNER JOIN usuarios AS u ON f.Usuario_Id = u.Id INNER JOIN barcos AS b ON f.Barco_Id = b.Id WHERE Id = :id ORDER BY Fecha DESC, Hora DESC";

      $resultado = $this->conexionBD->prepare($query);

      $resultado->execute(array(":id" => $id));

      return $resultado->fetch();
    }

    $query = "SELECT f.Id, f.Codigo, j.Fecha AS Jornada, CONCAT(u.Nombre, ' ', u.Apellidos) AS Cajero, b.Nombre AS Embarcacion, f.Mercancia_Recibida AS 'Mercancia Recibida (Kg)', f.Ganancia_Bruta AS 'Ganancia Bruta', f.Gastos_Operativos AS 'Gastos Operativos', f.Ganancia_Neta AS 'Ganancia Neta', f.Fecha, TIME_FORMAT(f.Hora, '%r') AS Hora FROM facturas AS f INNER JOIN jornadas AS j ON f.Jornada_Id = j.Id INNER JOIN usuarios AS u ON f.Usuario_Id = u.Id INNER JOIN barcos AS b ON f.Barco_Id = b.Id ORDER BY Fecha DESC, Hora DESC";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  public function update($id, $codigo, $jornada_id, $usuario_id, $barco_id, $fecha, $hora, $mercancia_recibida, $ganancia_bruta, $gastos_operativos, $ganancia_neta)
  {

    $query = "UPDATE facturas SET Codigo = :code, Jornada_Id = :working_day_id, Usuario_Id = :user_id, Barco_Id = :boat_id, Fecha = :date, Hora = :time, Mercancia_Recibida = :commodity_received, Ganancia_Bruta = :brute_worth, Gastos_Operativos = :operating_expenses, Ganancia_Neta = :net_worth WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(
      ":account_id" => $id,
      ':code' => $codigo,
      ':working_day_id' => $jornada_id,
      ':user_id' => $usuario_id,
      ':boat_id' => $barco_id,
      ':date' => $fecha,
      ':time' => $hora,
      ':commodity_received' => $mercancia_recibida,
      ':brute_worth' => $ganancia_bruta,
      ':operating_expenses' => $gastos_operativos,
      ':net_worth' => $ganancia_neta
    ));

    return header('location: ../../views/staff/data-display.php?table=facturas&success=true');
  }

  public function delete($id)
  {

    $query = "DELETE FROM facturas WHERE Id = :account_id";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":account_id" => $id));

    return header('location: ../../views/staff/data-display.php?table=facturas&success=true');
  }

  public function getLatest()
  {
    $query = "SELECT * FROM facturas ORDER BY Id DESC LIMIT 1;";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute();

    return $resultado->fetchAll();
  }

  public function defaultRead($id)
  {
    $query = "SELECT * FROM facturas WHERE Id = :id ORDER BY Fecha DESC, Hora DESC";

    $resultado = $this->conexionBD->prepare($query);

    $resultado->execute(array(":id" => $id));

    return $resultado->fetch();
  }
}
