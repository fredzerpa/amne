<?php

require_once('../../models/User.php');
require_once('../../utils/functions.php');

if (isset($_GET['error']) || isset($_GET['success'])) {
  unset($_SESSION['notification']);
  unset($_SESSION['notification_title']);
  unset($_SESSION['notification_message']);
}

switch ($_GET['action']) {
  case "create":
    if (
      isset($_POST['cedula']) &&
      isset($_POST['name']) &&
      isset($_POST['lastname']) &&
      isset($_POST['phone']) &&
      isset($_POST['email']) &&
      isset($_POST['address']) &&
      isset($_POST['password']) &&
      isset($_POST['repassword']) &&
      isset($_POST['nivel'])
    ) {

      if (
        $_POST['cedula'] != '' &&
        $_POST['name'] != '' &&
        $_POST['lastname'] != '' &&
        $_POST['phone'] != '' &&
        $_POST['email'] != '' &&
        $_POST['address'] != '' &&
        $_POST['password'] != '' &&
        $_POST['repassword'] != '' &&
        $_POST['nivel'] != ''
      ) {

        $cedula = clean($_POST['cedula']);
        $clave = clean($_POST['password']);
        $reclave = clean($_POST['repassword']);
        $nombre = clean($_POST['name']);
        $apellidos = clean($_POST['lastname']);
        $telefono = clean($_POST['phone']);
        $email = clean($_POST['email']);
        $direccion = clean($_POST['address']);
        $nivel = clean($_POST['nivel']);

        if (checkPassword($clave, $reclave)) {
          $user = new User();

          $clave = password_hash($clave, PASSWORD_DEFAULT);
          $user->create($cedula, $nombre, $apellidos, $telefono, $email, $direccion, $clave, $nivel);
        } else {
          $_SESSION['notification'] = true;
          $_SESSION['notification_title'] = 'Datos Invalidos';
          $_SESSION['notification_message'] = 'Las contraseñas no coinciden.';
          header('location: ../../views/admin/users.php?action=create&error=true');
        }
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/users.php?action=create&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/users.php?action=create&error=true');
    }
    break;
  case "update":
    if (
      isset($_POST['id']) &&
      isset($_POST['cedula']) &&
      isset($_POST['name']) &&
      isset($_POST['lastname']) &&
      isset($_POST['phone']) &&
      isset($_POST['email']) &&
      isset($_POST['address']) &&
      isset($_POST['nivel'])
    ) {

      if (
        $_POST['id'] != '' &&
        $_POST['cedula'] != '' &&
        $_POST['name'] != '' &&
        $_POST['lastname'] != '' &&
        $_POST['phone'] != '' &&
        $_POST['email'] != '' &&
        $_POST['address'] != '' &&
        $_POST['nivel'] != ''
      ) {

        $id = clean($_POST['id']);
        $cedula = clean($_POST['cedula']);
        $clave = clean($_POST['password']);
        $reclave = clean($_POST['repassword']);
        $nombre = clean($_POST['name']);
        $apellidos = clean($_POST['lastname']);
        $telefono = clean($_POST['phone']);
        $email = clean($_POST['email']);
        $direccion = clean($_POST['address']);
        $nivel = clean($_POST['nivel']);

        $user = new User();

        if ($_POST['password'] != '' && $_POST['repassword']) {
          if (checkPassword($clave, $reclave)) {
            $clave = password_hash($clave, PASSWORD_DEFAULT);
            $user->update($id, $cedula, $nombre, $apellidos, $telefono, $email, $direccion, $clave, $nivel);
          } else {
            $_SESSION['notification'] = true;
            $_SESSION['notification_title'] = 'Datos Invalidos';
            $_SESSION['notification_message'] = 'Las contraseñas no coinciden.';
            header('location: ../../views/admin/users.php?action=update&id=' . $id . '&error=true&clave=check');
          }
        } else {
          $user->update($id, $cedula, $nombre, $apellidos, $telefono, $email, $direccion, "", $nivel);
        }
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/users.php?action=update&id=' . $id . '&error=true&emptyfields=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/users.php?action=update&id=' . $id . '&error=true&unset=true');
    }
    break;
  case "delete":
    if (isset($_POST['id'])) {

      if ($_POST['id'] != "") {
        $id = clean($_POST['id']);
        $user = new User();
        $user->delete($id);
      } else {
        header('location: ../../views/admin/users.php?action=delete&id=' . $id . '&error=true');
      }
    } else {
      header('location: ../../views/admin/users.php?action=delete&id=' . $id . '&error=true');
    }
    break;
  case "updateRegular":
    if (
      isset($_POST['id']) && isset($_POST['fullname']) && isset($_POST['email'])
      && isset($_POST['address'])
    ) {

      if (
        $_POST['id'] != "" && $_POST['fullname'] != "" && $_POST['email'] != ""
        && $_POST['address'] != ""
      ) {

        $cedula = clean($_POST['cedula']);
        $nombre = clean($_POST['name']);
        $apellidos = clean($_POST['lastname']);
        $telefono = clean($_POST['phone']);
        $email = clean($_POST['email']);
        $direccion = clean($_POST['address']);

        $user = new User();

        $user->updateRegular($id, $cedula, $nombre, $apellidos, $telefono, $email, $direccion);
      } else {
        header('location: ../../views/regular/account/account.php?id=' . $_POST['id'] . '&incomplete=true');
      }
    } else {
      header('location: ../../views/regular/account/account.php?id=' . $_POST['id'] . '&unset=true');
    }
    break;
}
