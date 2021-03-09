<?php
session_start();

$action_type = $_GET['action'];

if (!isset($_SESSION['usuario']) || !isset($_SESSION['account_id'])) {
  header('location: ../login/login.php');
} else if (!$_SESSION['isAdmin']) {
  $_SESSION['notification'] = true;
  $_SESSION['notification_title'] = 'No estas Autorizado para realizar esta accion.';
  $_SESSION['notification_message'] = 'No estas Autorizado para realizar esta accion.';
  header('location: ../cms/cms.php?error=true');
}


require_once('../../models/WorkingDays.php');
$query = new WorkingDay();

$response = ($action_type != 'create') ? $query->readDefault($_GET['id']) : null;

if ($action_type != 'create') {
  $id = $response['Id'];
  $date = $response['Fecha'];
  $time_start = $response['Hora_Inicio'];
  $time_end = $response['Hora_Cierre'];
  $weather = $response['Clima'];
  $price = $response['Precio'];
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
              echo 'Actualizar Jornada';
              break;
            case 'delete':
              echo 'Eliminar Jornada';
              break;
            case 'create':
              echo 'Crear Jornada';
              break;
          }
          ?>
        </h1>
        <hr />
        <form method="POST" action="../../controllers/working-days/WorkingDaysControllers.php?action=<?php echo $action_type; ?>">
          <?php if ($action_type != 'create') { ?>
            <div class="form-group sm-size" style="display: none;">
              <label class="form-input-title">Id</label>
              <input type="text" maxlength="50" id="account_id" name="id" class="form-control" placeholder="Id" value="<?php echo @$id; ?>" <?php echo $action_type != 'create' ? 'required' : null; ?> />
            </div>
          <?php } ?>
          <div class="wrapper">
            <div class="form-group sm-size">
              <label class="form-input-title">Clima</label>
              <input type="text" id="weather" name="weather" class="form-control" placeholder="Ej: Soleado" required value="<?php echo @$weather; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="form-input-title">Fecha</label>
            <input type="date" id="date" name="date" class="form-control md-size" placeholder="Codigo de Identificacion" required value="<?php echo @$date; ?>" />
          </div>
          <div class="wrapper">
            <div class="form-group sm-size">
              <label class="form-input-title">Hora de Inicio</label>
              <input type="time" id="open-time" name="time_start" class="form-control" required value="<?php echo @$time_start; ?>" />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Hora de Cierre</label>
              <input type="time" id="closing-time" name="time_end" class="form-control" required value="<?php echo @$time_end; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="form-input-title">Precio (Kg)</label>
            <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" class="form-control sm-size" name="price" id="prod-price" placeholder="Precio por Kg" rows="5" required value="<?php echo @$price; ?>" /> $
          </div>
          <div class="form-group submit-button-container">
            <?php if ($action_type == 'update') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=delete&id=' . $_GET['id']; ?>" class=""><input type="button" value="Eliminar Jornada" class="form-button" />
              </a>
              <input type="submit" value="Confirmar Actualizar" class="form-button" />
            <?php } else if ($action_type == 'delete') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=update&id=' . $_GET['id']; ?>" class=""><input type="button" value="Actualizar Jornada" class="form-button" />
              </a>
              <input type="submit" value="Confirmar Eliminar" class="form-button" />
            <?php } else { ?>
              <input type="submit" value="Confirmar Agregar" class="form-button" />
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