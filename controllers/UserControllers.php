<?php

require_once('../models/User.php');
require_once('../utils/functions.php');

switch ($_GET['action']) {
  case "create":
    if (
      isset($_POST['username']) &&
      isset($_POST['nombre']) &&
      isset($_POST['lastname']) &&
      isset($_POST['phone']) &&
      isset($_POST['email']) &&
      isset($_POST['address']) &&
      isset($_POST['password']) &&
      isset($_POST['repassword']) &&
      isset($_POST['level'])
    ) {

      if (
        $_POST['username'] != '' &&
        $_POST['nombre'] != '' &&
        $_POST['lastname'] != '' &&
        $_POST['phone'] != '' &&
        $_POST['email'] != '' &&
        $_POST['address'] != '' &&
        $_POST['password'] != '' &&
        $_POST['repassword'] != '' &&
        $_POST['level'] != ''
      ) {

        $cedula = clean($_POST['username']);
        $clave = clean($_POST['password']);
        $reclave = clean($_POST['repassword']);
        $nombre = clean($_POST['name']);
        $lastname = clean($_POST['lastname']);
        $telefono = clean($_POST['phone']);
        $correo = clean($_POST['email']);
        $direccion = clean($_POST['address']);
        $nivel = clean($_POST['level']);

        if (checkPassword($clave, $reclave)) {
          $user = new User();

          $clave = password_hash($clave, PASSWORD_DEFAULT);
          $user->create($cedula, $nombre, $apellidos, $telefono, $email, $direccion, $clave, $nivel);
        } else {
          header('location: ../views/admin/forms/createUser.php?confirmPassword=false');
        }
      } else {
        header('location: ../views/admin/forms/createUser.php?incompletefields=true');
      }
    } else {
      header('location: ../views/admin/forms/createUser.php?unset=true');
    }
  case "update":
    if (
      isset($_POST['id']) && isset($_POST['user']) && isset($_POST['fullname']) && isset($_POST['email'])
      && isset($_POST['address']) && isset($_POST['role'])
    ) {

      if (
        $_POST['username'] != '' &&
        $_POST['nombre'] != '' &&
        $_POST['lastname'] != '' &&
        $_POST['phone'] != '' &&
        $_POST['email'] != '' &&
        $_POST['address'] != '' &&
        $_POST['level'] != ''
      ) {

        $id = clean($_POST['id']);
        $usuario = clean($_POST['user']);
        $nombre = clean($_POST['fullname']);
        $correo = clean($_POST['email']);
        $direccion = clean($_POST['address']);
        $rol = clean($_POST['role']);

        $user = new User();

        $user->update($id, $usuario, $nombre, $correo, $direccion, $rol);
      } else {
        header('location: ../views/admin/forms/updateUser.php?id=' . $_POST['id'] . '&incomplete=true');
      }
    } else {
      header('location: ../views/admin/forms/updateUser.php?id=' . $_POST['id'] . '&unset=true');
    }
  case "delete":
    if (isset($_GET['id'])) {

      if ($_GET['id'] != "") {
        $id = clean($_GET['id']);
        $user = new User();
        $user->delete($id);
      } else {
        header('location: ../views/admin/users/users.php?incomplete=true');
      }
    } else {
      header('location: ../views/admin/users/users.php?unset=true');
    }
  case "updateRegular":
    if (
      isset($_POST['id']) && isset($_POST['fullname']) && isset($_POST['email'])
      && isset($_POST['address'])
    ) {

      if (
        $_POST['id'] != "" && $_POST['fullname'] != "" && $_POST['email'] != ""
        && $_POST['address'] != ""
      ) {

        $id = clean($_POST['id']);
        $nombre = clean($_POST['fullname']);
        $correo = clean($_POST['email']);
        $direccion = clean($_POST['address']);

        $user = new User();

        $user->updateRegular($id, $nombre, $correo, $direccion);
      } else {
        header('location: ../views/regular/account/account.php?id=' . $_POST['id'] . '&incomplete=true');
      }
    } else {
      header('location: ../views/regular/account/account.php?id=' . $_POST['id'] . '&unset=true');
    }
}
