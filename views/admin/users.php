<?php
session_start();

$action_type = $_GET['action'];

if (!isset($_SESSION['usuario']) || !isset($_SESSION['account_id'])) {
  header('location: ../../login/login.php');
} else if (!$_SESSION['isAdmin'] && $action_type != 'update' && @$_GET['id'] == $_SESSION['account_id']) {
  $_SESSION['notification'] = true;
  $_SESSION['notification_title'] = 'No estas Autorizado para realizar esta accion.';
  $_SESSION['notification_message'] = 'No estas Autorizado para realizar esta accion.';
  header('location: ../cms/cms.php?error=true');
}

require_once('../../models/User.php');
$query = new User();

$response = ($action_type != 'create') ? $query->read($_GET['id']) : null;

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
      <?php include_once('../../components/notifications/notification-message.php'); ?>
      <article class="wrapper" id="data-display">
        <h1 class="display-data-title" id="title">
          <?php switch ($action_type) {
            case 'update':
              echo 'Actualizar Usuario';
              break;
            case 'delete':
              echo 'Eliminar Usuario';
              break;
            case 'create':
              echo 'Crear Usuario';
              break;
          }
          ?>
        </h1>
        <hr />
        <form method="POST" action="../../controllers/users/UserControllers.php?action=<?php echo $action_type; ?>">
          <?php if ($action_type != 'create') { ?>
            <div class="form-group sm-size" style="display: none;">
              <label class="form-input-title">Id</label>
              <input type="text" maxlength="50" id="account_id" name="id" class="form-control" placeholder="Id" value="<?php if ($action_type != 'create') {
                                                                                                                          echo $response['Id'];
                                                                                                                        } ?>" required />
            </div>
          <?php } ?>
          <div class="wrapper">
            <div class="form-group md-size">
              <label class="form-input-title">Cedula</label>
              <input type="text" id="cedula" name="cedula" class="form-control" minlength="6" maxlength="10" required placeholder="Numero de Cedula" value="<?php if ($action_type != 'create') {
                                                                                                                                                              echo $response['Cedula'];
                                                                                                                                                            } ?>" />
            </div>
            <?php
            if ($_SESSION['isAdmin'] && (($_SESSION['account_id'] != @$_GET['id']) || ($action_type == 'create'))) {

              echo '<div class="form-group sm-size">';
            } else {
              echo '<div class="form-group sm-size" style="display: none;">';
            }
            ?>
            <label class="form-input-title">Nivel</label>
            <select name="nivel" class="form-control" id="nivel" required>
              <option value="1" <?php if ($action_type != 'create') {
                                  if ($response['Nivel'] == 1) {
                                    echo 'selected';
                                  }
                                } ?>> Administrador </option>
              <option value="2" <?php if ($action_type != 'create') {
                                  if ($response['Nivel'] == 2) {
                                    echo 'selected';
                                  }
                                } ?>>Cajero</option>
            </select>
          </div>
          </div>
          <div class="wrapper">
            <div class="form-group sm-size">
              <label class="form-input-title">Nombre</label>
              <input type="text" maxlength="50" id="name" name="name" class="form-control" placeholder="Nombre" value="<?php if ($action_type != 'create') {
                                                                                                                          echo $response['Nombre'];
                                                                                                                        } ?>" required />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Apellidos</label>
              <input type="text" maxlength="50" id="lastname" name="lastname" class="form-control" placeholder="Apellidos" value="<?php if ($action_type != 'create') {
                                                                                                                                    echo $response['Apellidos'];
                                                                                                                                  } ?>" required />
            </div>
          </div>
          <div class="wrapper">
            <div class="form-group sm-size">
              <label class="form-input-title">Email</label>
              <input type="email" maxlength="50" id="email" name="email" class="form-control" placeholder="Ej: example@gmail.com" value="<?php if ($action_type != 'create') {
                                                                                                                                            echo $response['Email'];
                                                                                                                                          } ?>" required />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Telefono</label>
              <input type="tel" minlength="12" maxlength="13" id="phone" name="phone" class="form-control " placeholder="Codigo de Identificacion" value="<?php if ($action_type != 'create') {
                                                                                                                                                            echo $response['Telefono'];
                                                                                                                                                          } ?>" />
            </div>
          </div>

          <div class="form-group">
            <label class="form-input-title">Direccion de Habitacion</label>
            <textarea class="form-control" name="address" id="address" placeholder="Direccion de Habitacion" rows="2" maxlength="255" required><?php if ($action_type != 'create') {
                                                                                                                                                  echo $response['Direccion'];
                                                                                                                                                } ?></textarea>
          </div>
          <div class="wrapper">
            <div class="form-group sm-size">
              <label class="form-input-title">Clave</label>
              <input type="password" maxlength="32" id="password" name="password" class="form-control" placeholder="Clave" <?php echo ($action_type == 'create') ? 'required' : null ?> />
            </div>
            <div class="form-group sm-size">
              <label class="form-input-title">Repita Clave</label>
              <input type="password" maxlength="32" id="repassword" name="repassword" class="form-control" placeholder="Repita Clave" <?php echo ($action_type == 'create') ? 'required' : null ?> />
            </div>
          </div>
          <div class="form-group submit-button-container">
            <?php if ($action_type == 'update') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=delete&id=' . $_GET['id']; ?>" class=""><input type="button" value="Eliminar Usuario" class="form-button" />
              </a>
              <input type="submit" value="Actualizar" class="form-button" />
            <?php } else if ($action_type == 'delete') { ?>
              <a href="<?php echo $_SERVER['PHP_SELF'] . '?action=update&id=' . $_GET['id']; ?>" class=""><input type="button" value="Actualizar Usuario" class="form-button" />
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