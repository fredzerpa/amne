<?php

require_once('../../models/Boats.php');
require_once('../../utils/functions.php');

if (isset($_GET['error']) || isset($_GET['success'])) {
  unset($_SESSION['notification']);
  unset($_SESSION['notification_title']);
  unset($_SESSION['notification_message']);
}

switch ($_GET['action']) {
  case "create":
    if (
      isset($_POST['owner']) &&
      isset($_POST['name']) &&
      isset($_POST['crew_quantity']) &&
      isset($_POST['load_capacity'])
    ) {

      if (
        $_POST['owner'] != '' &&
        $_POST['name'] != '' &&
        $_POST['crew_quantity'] != '' &&
        $_POST['load_capacity'] != ''
      ) {

        $owner = clean($_POST['owner']);
        $name = clean($_POST['name']);
        $crew_quantity = clean($_POST['crew_quantity']);
        $load_capacity = clean($_POST['load_capacity']);

        $boat = new Boat();
        $code = uniqid();
        $boat->create($name, $code, $owner, $crew_quantity, $load_capacity);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/boats.php?action=create&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/boats.php?action=create&error=true');
    }
    break;
  case "update":
    if (
      isset($_POST['boat_id']) &&
      isset($_POST['code']) &&
      isset($_POST['owner']) &&
      isset($_POST['name']) &&
      isset($_POST['crew_quantity']) &&
      isset($_POST['load_capacity'])
    ) {

      if (
        $_POST['boat_id'] != '' &&
        $_POST['code'] != '' &&
        $_POST['owner'] != '' &&
        $_POST['name'] != '' &&
        $_POST['crew_quantity'] != '' &&
        $_POST['load_capacity'] != ''
      ) {

        $id = clean($_POST['boat_id']);
        $code = clean($_POST['code']);
        $owner = clean($_POST['owner']);
        $name = clean($_POST['name']);
        $crew_quantity = clean($_POST['crew_quantity']);
        $load_capacity = clean($_POST['load_capacity']);

        $boat = new Boat();
        $boat->update($id, $name, $code, $owner, $crew_quantity, $load_capacity);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/boats.php?action=update&id='.$_POST['boat_id'].'&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/boats.php?action=update&id='.$_POST['boat_id'].'&error=true');
    }
    break;
  case "delete":
    if (isset($_POST['boat_id'])) {

      if ($_POST['boat_id'] != "") {
        $id = clean($_POST['boat_id']);
        $boat = new Boat();
        $boat->delete($id);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/boats.php?action=delete&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/boats.php?action=delete&error=true');
    }
    break;
}
