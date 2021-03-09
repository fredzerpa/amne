<?php

require_once('../models/Auth.php');
$verificar = new Auth();

session_start();

if ($verificar->login()) {
  $_SESSION['usuario'] = $verificar->getUsuario();
  $_SESSION['account_id'] = $verificar->getAccountId();
  $_SESSION['nivel'] = $verificar->getRole();
  $_SESSION['nombre'] = $verificar->getName();

  if ($_SESSION['nivel'] == 1) {
    $_SESSION['isAdmin'] = true;
  } else {
    $_SESSION['isAdmin'] = false;
  }

  header('location: ../views/cms/cms.php');
} else {
  $_SESSION['notification'] = true;
  $_SESSION['notification_title'] = 'Datos Invalidos';
  $_SESSION['notification_message'] = 'Usuario y/o Clave Erronea.';
  header('location: ../views/login/login.php?error=true');
}
