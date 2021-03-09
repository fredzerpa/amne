<?php

  function clean($data){
    return htmlentities(addslashes($data));
  }

  function checkPassword($pass,$confirmPass){
    return $pass == $confirmPass;
  }
