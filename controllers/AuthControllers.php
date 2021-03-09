<?php

  require_once('../models/Auth.php');
  $verificar = new Auth();

  session_start();

  if($verificar->login()){
    $_SESSION['usuario'] = $verificar->getUsuario();
    $_SESSION['account_id'] = $verificar->getAccountId();
    $_SESSION['level'] = $verificar->getRole();
    
    switch($_SESSION['level']){
      case 1:
        header('location: ../views/regular/home/home.php');
        break;
      case 2:
        header('location: ../views/admin/home/home.php');
        break;
    }
  }else{
    $_SESSION['error'] = true;
    header('location: ../views/login/login.php?error=true');
  }