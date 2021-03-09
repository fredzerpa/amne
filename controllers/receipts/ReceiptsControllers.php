<?php

require_once('../../models/Receipts.php');
require_once('../../utils/functions.php');

require_once('../../models/WorkingDays.php');
$queryWorkingDay = new WorkingDay();



if (isset($_GET['error']) || isset($_GET['success'])) {
  unset($_SESSION['notification']);
  unset($_SESSION['notification_title']);
  unset($_SESSION['notification_message']);
}

switch ($_GET['action']) {
  case "create":
    if (
      isset($_POST['working_day_id']) &&
      isset($_POST['emp_id']) &&
      isset($_POST['boat_id']) &&
      isset($_POST['date']) &&
      isset($_POST['time']) &&
      isset($_POST['commodity'])
    ) {
      if (
        $_POST['working_day_id'] != '' &&
        $_POST['emp_id'] != '' &&
        $_POST['boat_id'] != '' &&
        $_POST['date'] != '' &&
        $_POST['time'] != '' &&
        $_POST['commodity'] != ''
      ) {

        
        $working_day_id = clean($_POST['working_day_id']);
        $emp_id = clean($_POST['emp_id']);
        $boat_id = clean($_POST['boat_id']);
        $date = clean($_POST['date']);
        $time = clean($_POST['time']);
        $commodity = clean($_POST['commodity']);
        $responseWorkingDay = $queryWorkingDay->readDefault($working_day_id);
        $brute_worth = $commodity * $responseWorkingDay['Precio'];
        $brute_worth = round($brute_worth, 2);
        $operating_expenses = $brute_worth - (($brute_worth * rand(10, 15)) / 100);
        $operating_expenses = round($operating_expenses, 2);
        $net_worth = $brute_worth - $operating_expenses;
        $net_worth = round($net_worth, 2);
        
        echo $brute_worth . '<br/>';
        echo $operating_expenses . '<br/>';
        echo $net_worth . '<br/>';
        
        $receipt = new Receipt();
        $code = uniqid();
        $receipt->create($code, $working_day_id, $emp_id, $boat_id, $date, $time, $commodity, $brute_worth, $operating_expenses, $net_worth);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/receipts.php?action=create&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/receipts.php?action=create&error=true');
    }
    break;
  case "update":
    if (
      isset($_POST['id']) &&
      isset($_POST['working_day_id']) &&
      isset($_POST['emp_id']) &&
      isset($_POST['boat_id']) &&
      isset($_POST['date']) &&
      isset($_POST['time']) &&
      isset($_POST['commodity']) &&
      isset($_POST['brute_worth']) &&
      isset($_POST['operating_expenses']) &&
      isset($_POST['net_worth'])
    ) {

      if (
        $_POST['id'] != '' &&
        $_POST['working_day_id'] != '' &&
        $_POST['emp_id'] != '' &&
        $_POST['boat_id'] != '' &&
        $_POST['date'] != '' &&
        $_POST['time'] != '' &&
        $_POST['commodity'] != '' &&
        $_POST['brute_worth'] != '' &&
        $_POST['operating_expenses'] != '' &&
        $_POST['net_worth'] != ''
      ) {

        
        $id = clean($_POST['id']);
        $code = clean($_POST['code']);
        $working_day_id = clean($_POST['working_day_id']);
        $emp_id = clean($_POST['emp_id']);
        $boat_id = clean($_POST['boat_id']);
        $date = clean($_POST['date']);
        $time = clean($_POST['time']);
        $commodity = clean($_POST['commodity']);
        $responseWorkingDay = $queryWorkingDay->readDefault($working_day_id);
        $brute_worth = $commodity * $responseWorkingDay['Precio'];
        $operating_expenses = ($brute_worth - (($brute_worth * rand(10, 15)) / 100));
        $net_worth = $brute_worth - $operating_expenses;

        $receipt = new Receipt();
        $receipt->update($id, $code, $working_day_id, $emp_id, $boat_id, $date, $time, $commodity, $brute_worth, $operating_expenses, $net_worth);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/receipts.php?action=update&id=' . $_POST['boat_id'] . '&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/receipts.php?action=update&id=' . $_POST['boat_id'] . '&error=true');
    }
    break;
  case "delete":
    if (isset($_POST['boat_id'])) {

      if ($_POST['boat_id'] != "") {
        $id = clean($_POST['boat_id']);
        $receipt = new Receipt();
        $receipt->delete($id);
      } else {
        $_SESSION['notification'] = true;
        $_SESSION['notification_title'] = 'Campos Vacios';
        $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
        header('location: ../../views/admin/receipts.php?action=delete&error=true');
      }
    } else {
      $_SESSION['notification'] = true;
      $_SESSION['notification_title'] = 'Campos Vacios';
      $_SESSION['notification_message'] = 'Por favor, llene todos los campos.';
      header('location: ../../views/admin/receipts.php?action=delete&error=true');
    }
    break;
}

print_r($responseWorkingDay);