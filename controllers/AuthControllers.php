<?php

require_once('../models/Auth.php');
$verificar = new Auth();

session_start();

if ($verificar->login()) {
  
  unset($_SESSION['error']);
  unset($_SESSION['errorMessage']);
  $_SESSION['usuario'] = $verificar->getUsuario();
  $_SESSION['account_id'] = $verificar->getAccountId();
  $_SESSION['level'] = $verificar->getRole();
  
  header('location: ../views/cms/cms.php');
  
} else {
  
  $_SESSION['error'] = true;
  $_SESSION['errorMessage'] = 'Usuario y/o Clave Erronea';
  header('location: ../views/login/login.php?userVerif=false');
  
}

?>