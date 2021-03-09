<?php
session_start();

$action_type = $_GET['action'];

if (!isset($_SESSION['usuario']) || !isset($_SESSION['account_id'])) {
  header('location: ../../login/login.php');
} else if (!$_SESSION['isAdmin'] && $action_type != 'create') {
  $_SESSION['notification'] = true;
  $_SESSION['notification_title'] = 'No estas Autorizado para realizar esta accion.';
  $_SESSION['notification_message'] = 'No estas Autorizado para realizar esta accion.';
  header('location: ../cms/cms.php?error=true');
}

require_once('../../models/Receipts.php');
$query = new Receipt();

$response = ($action_type != 'create') ? $query->defaultRead($_GET['id']) : null;

require_once('../../models/User.php');
$queryUser = new User();

require_once('../../models/Boats.php');
$queryBoat = new Boat();

require_once('../../models/WorkingDays.php');
$queryWorkingDay = new WorkingDay();

if ($action_type != 'create') {
  $id = $response['Id'];
  $code = $response['Codigo'];
  $working_day_id = $response['Jornada_Id'];
  $emp_id = $response['Usuario_Id'];
  $boat_id = $response['Barco_Id'];
  $date = $response['Fecha'];
  $time = $response['Hora'];
  $commodity = $response['Mercancia_Recibida'];
  $brute_worth = $response['Ganancia_Bruta'];
  $operating_expenses = $response['Gastos_Operativos'];
  $net_worth = $response['Ganancia_Neta'];

  $responseUser = array($queryUser->read($emp_id));
  $responseBoat = array($queryBoat->read($boat_id));
  $responseWorkingDay = array($queryWorkingDay->read($working_day_id));
} else {
  $responseUser = $queryUser->read();
  $responseBoat = $queryBoat->read();
  $responseWorkingDay = $queryWorkingDay->read();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Head Meta Tags & Icons Links -->
  <?php require_once('../../components/cms/head/head.php') ?>

  <!-- CSS -->
  <link rel="stylesheet" href="../../assets/css/cms/mode/edit.css" />
  <title>CMS - AMNE</title>
</head>

<body>
  <!-- Start Header Section -->
  <?php require_once('../../components/cms/cms-header.php') ?>
  <!-- End Header Section -->

  <!-- Start Main Section -->
  <main>
    <!-- Start Side Bar Section -->
    <?php require_once('../../components/cms/cms-sidebar.php') ?>
    <!-- End Side Bar Section -->

    <!-- Start Displayed Data Section -->
    <article class="container">
      <article class="wrapper" id="data-display">
        <h1 class="display-data-title" id="title">
          <?php switch ($action_type) {
            case 'update':
              echo 'Actualizar Facturas';
              break;
            case 'delete':
              echo 'Eliminar Facturas';
              break;
            case 'create':
              echo 'Crear Facturas';
              break;
          }
          ?>
        </h1>
        <hr />
        <form method="POST" action="../../controllers/receipts/ReceiptsControllers.php?action=<?php echo $action_type; ?>">
          <?php if ($action_type != 'create') { ?>
            <div class="form-group sm-size" style="display: none;">
              <label class="form-input-title">Id</label>
              <input type="text" maxlength="50" id="account_id" name="id" class="form-control" placeholder="Id" value="<?php echo @$id; ?>" <?php echo $action_type != 'create' ? 'required' : null; ?> />
            </div>
          <?php } ?>
          <div class="form-group sm-size">
            <label class="form-input-title">Codigo</label>
            <input type="text" maxlength="50" id="account_id" name="code" class="form-control" placeholder="Codigo de Factura" value="<?php echo @$code; ?>" <?php echo $action_type != 'create' ? 'required' : 'readonly'; ?> />
          </div>
          <div class="wrapper">
            <div class="form-group md-size">
              <label class="form-input-title">Fecha</label>
              <input type="date" id="date" name="date" class="form-control" placeholder="Codigo de Identificacion" required value="<?php echo @$date; ?>" />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Hora</label>
              <input type="time" id="time" name="time" class="form-control" required value="<?php echo @$time; ?>" />
            </div>
          </div>
          <?php  ?>
          <div class="wrapper">
            <div class="form-group sm-size">
              <label class="form-input-title">Jornada</label>
              <select name="working_day_id" class="form-control lg-size" required>
                <?php foreach ($responseWorkingDay as $working_day) { ?>
                  <option value="<?php echo $working_day['Id']; ?>"><?php echo $working_day['Fecha']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Embarcacion</label>
              <select name="boat_id" class="form-control lg-size" required>
                <?php foreach ($responseBoat as $boat) { ?>
                  <option value="<?php echo $boat['Id']; ?>"><?php echo $boat['Nombre']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Cajero</label>
              <select name="emp_id" class="form-control lg-size" required>
                <?php foreach ($responseUser as $user) { ?>
                  <option value="<?php echo $user['Id']; ?>"><?php echo $user['Nombre']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="wrapper">
            <div class="form-group md-size">
              <label class="form-input-title md-size">Mercancia Recibida</label>
              <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" id="commodity" name="commodity" class="form-control " placeholder="Monto de Mercancia Recibida: $" required value="<?php echo @$commodity; ?>" />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Ganancia Bruta</label>
              <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" id="brute-worth" name="brute_worth" class="form-control" required value="<?php echo @$brute_worth; ?>" placeholder="Ganancia Bruta: $" readonly />
            </div>
          </div>
          <div class="wrapper">
            <div class="form-group md-size">
              <label class="form-input-title md-size">Gastos Operativos</label>
              <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" id="expenses" name="operating_expenses" class="form-control" placeholder="Gastos Operativos: $" required value="<?php echo @$operating_expenses; ?>" readonly />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Ganancia Neta</label>
              <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" id="net-worth" name="net_worth" class="form-control" required value="<?php echo @$net_worth; ?>" placeholder="Ganancia Neta: $" readonly />
            </div>
          </div>

          <div class="form-group submit-button-container">
            <?php if ($action_type == 'update') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=delete&id=' . $_GET['id']; ?>" class=""><input type="button" value="Eliminar Factura" class="form-button" />
              </a>
              <input type="submit" value="Actualizar" class="form-button" />
            <?php } else if ($action_type == 'delete') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=update&id=' . $_GET['id']; ?>" class=""><input type="button" value="Actualizar Factura" class="form-button" />
              </a>
              <input type="submit" value="Eliminar" class="form-button" />
            <?php } else { ?>
              <input type="submit" value="Agregar" class="form-button" />
            <?php } ?>
          </div>
        </form>

      </article>
    </article>
    <!-- End Displayed Data Section -->
  </main>
  <script src="../../assets/fontawesome/js/all.min.js"></script>
</body>

</html>