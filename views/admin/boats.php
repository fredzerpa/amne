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


require_once('../../models/Boats.php');
$query = new Boat();

$response = ($action_type != 'create') ? $query->read($_GET['id']) : null;

print_r($response);

if ($action_type != 'create') {
  $id = $response['Id'];
  $name = $response['Nombre'];
  $code = $response['Codigo'];
  $owner = $response['Titular'];
  $crew_quantity = $response['Cantidad_Tripulantes'];
  $load_capacity = $response['Capacidad_Carga'];
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
              echo 'Actualizar Barco';
              break;
            case 'delete':
              echo 'Eliminar Barco';
              break;
            case 'create':
              echo 'Crear Barco';
              break;
          }
          ?>
        </h1>
        <hr />
        <form method="POST" action="../../controllers/boats/BoatsControllers.php?action=<?php echo $action_type; ?>">
          <?php if ($action_type != 'create') { ?>
            <div class="form-group sm-size" style="display: none;">
              <label class="form-input-title">Id</label>
              <input type="text" maxlength="50" id="account_id" name="boat_id" class="form-control" placeholder="Id" value="<?php echo @$id; ?>" <?php echo $action_type != 'create' ? 'required' : null; ?> />
            </div>
          <?php } ?>
          <div class="form-group">
            <label class="form-input-title">Codigo de Identificacion</label>
            <input type="text" id="id-code" name="code" class="form-control md-size" readonly placeholder="Codigo de Identificacion" value="<?php echo @$code; ?>" />
          </div>
          <div class="form-group">
            <label class="form-input-title">Titular del Barco</label>
            <input type="text" id="boat-owner" name="owner" class="form-control md-size" placeholder="Nombre del Titular" required value="<?php echo @$owner; ?>" />
          </div>
          <div class="wrapper">
            <div class="form-group sm-size">
              <label class="form-input-title">Nombre del Barco</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required value="<?php echo @$name; ?>" />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Cantidad de Tripulantes</label>
              <input type="number" id="num-emp" name="crew_quantity" class="form-control" placeholder="# Tripulantes" required value="<?php echo @$crew_quantity; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="form-input-title">Capacidad</label>
            <input class="form-control" name="load_capacity" id="load-capacity" placeholder="Capacidad de Carga (Kg)" rows="5" value="<?php echo @$load_capacity; ?>"/>
          </div>
          <div class="form-group submit-button-container">
            <?php if ($action_type == 'update') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=delete&id=' . $_GET['id']; ?>" class=""><input type="button" value="Eliminar Barco" class="form-button" />
              </a>
              <input type="submit" value="Confirmar Actualizar" class="form-button" />
            <?php } else if ($action_type == 'delete') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=update&id=' . $_GET['id']; ?>" class=""><input type="button" value="Actualizar Barco" class="form-button" />
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