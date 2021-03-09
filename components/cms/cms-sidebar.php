<?php

$path = $_SERVER['REQUEST_URI'];

if (strstr($path, 'working-days.php') || strstr($path, 'table=jornadas')) {
  $workingday = 'active';
  $boats = '';
  $receipts = '';
  $users = '';
} else if (strstr($path, 'boats.php') || strstr($path, 'table=barcos')) {
  $workingday = '';
  $boats = 'active';
  $receipts = '';
  $users = '';
} else if (strstr($path, 'receipts.php') || strstr($path, 'table=facturas')) {
  $workingday = '';
  $boats = '';
  $receipts = 'active';
  $users = '';
} else if (strstr($path, 'users.php') || strstr($path, 'table=usuarios')) { 
  $workingday = '';
  $boats = '';
  $receipts = '';
  $users = 'active';
} else {
  $workingday = '';
  $boats = '';
  $receipts = '';
  $users = '';
}
?>
<!-- Start Side Bar Section -->
<aside class="side-navbar">
  <ul class="side-nav">
    <li class="side-nav-link <?php echo $workingday ?>">
      <a class="link" href="../staff/data-display.php?table=jornadas">
        <div class="icon-container"><i class="far fa-clock"></i></div>
        Jornadas
      </a>
    </li>
    <li class="side-nav-link <?php echo $boats ?>">
      <a class="link" href="../staff/data-display.php?table=barcos">
        <div class="icon-container"><i class="fas fa-ship"></i></div>
        Barcos
      </a>
    </li>
    <li class="side-nav-link <?php echo $receipts ?>">
      <a class="link" href="../staff/data-display.php?table=facturas">
        <div class="icon-container"><i class="fas fa-receipt"></i></div>
        Facturas
      </a>
    </li>
    <li class="side-nav-link <?php echo $users ?>">
      <a class="link" href="../staff/data-display.php?table=usuarios">
        <div class="icon-container"><i class="fas fa-user-alt"></i></div>
        Usuarios
      </a>
    </li>
    <li class="side-nav-link user-name">
      <span class="username">
        Usuario: <i class="displayed-username"><?php echo $_SESSION['nombre']; ?></i>
      </span>
    </li>
  </ul>
</aside>
<!-- End Side Bar Section -->