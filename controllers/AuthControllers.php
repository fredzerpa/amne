<?php

require_once('../models/Auth.php');
$verificar = new Auth();

session_start();

if ($verificar->login()) {
  
  $_SESSION['usuario'] = $verificar->getUsuario();
  $_SESSION['account_id'] = $verificar->getAccountId();
  $_SESSION['level'] = $verificar->getRole();

  header('location: ../views/cms/cms.php');
  
} else {
  
  $_SESSION['error'] = true;
  header('location: ../views/login/login.php?error=true');
  
}

?>