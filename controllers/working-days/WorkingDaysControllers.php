<?php

require_once('../../models/WorkingDays.php');
require_once('../../utils/functions.php');

if (isset($_GET['error']) || isset($_GET['success'])) {
  unset($_SESSION['notification']);
  unset($_SESSION['notification_title']);
  unset($_SESSION['notification_message']);
}

switch ($_GET['action']) {
  case "create":
    if (
      isset($_POST['date']) &&
      isset($_POST['time_start']) &&
      isset($_POST['time_end']) &&
      isset($_POST['weather']) &&
      isset($_POST['price'])
    ) {

      if (
        $_POST['date'] != '' &&
        $_POST['time_start'] != '' &&
        $_POST['time_end'] != '' &&
        $_POST['weather'] != '' &&
        $_POST['price'] != ''
      ) {

        $date = clean($_POST['date']);
        $time_start = clean($_POST['time_start']);
        $time_end = clean($_POST['time_end']);
        $weather = clean($_POST['weather']);
        $price = clean($_POST['price']);

        $working_day = new WorkingDay();
        $working_day->create($date, $time_start, $time_end, $weather, $price);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/working-days.php?action=create&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/working-days.php?action=create&error=true');
    }
    break;
  case "update":
    if (
      isset($_POST['id']) &&
      isset($_POST['date']) &&
      isset($_POST['time_start']) &&
      isset($_POST['time_end']) &&
      isset($_POST['weather']) &&
      isset($_POST['price'])
    ) {

      if (
        $_POST['id'] != '' &&
        $_POST['date'] != '' &&
        $_POST['time_start'] != '' &&
        $_POST['time_end'] != '' &&
        $_POST['weather'] != '' &&
        $_POST['price'] != ''
      ) {

        $id = clean($_POST['id']);
        $date = clean($_POST['date']);
        $time_start = clean($_POST['time_start']);
        $time_end = clean($_POST['time_end']);
        $weather = clean($_POST['weather']);
        $price = clean($_POST['price']);

        $working_day = new WorkingDay();
        $working_day->update($id, $date, $time_start, $time_end, $weather, $price);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/working-days.php?action=update&id=' . $_POST['id'] . '&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/working-days.php?action=update&id=' . $_POST['id'] . '&error=true');
    }
    break;
  case "delete":
    if (isset($_POST['id'])) {

      if ($_POST['id'] != "") {
        $id = clean($_POST['id']);
        $working_day = new WorkingDay();
        $working_day->delete($id);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/working-days.php?action=delete&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/working-days.php?action=delete&error=true');
    }
    break;
}
