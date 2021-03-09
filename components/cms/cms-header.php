<header>
  <nav>
    <ul class="navbar">
      <li class="navbar-item">
        <a class="nav-link" href="../cms/cms.php">
          <i class="fas fas fa-tachometer-alt icon"></i>Dashboard
        </a>
      </li>
      <li class="navbar-item">
        <a class="nav-link" href="../admin/users.php?action=update&id=<?php echo $_SESSION['account_id']; ?>"> Actualizar Perfil</a>
      </li>
      <li class="navbar-item">
        <a class="nav-link" href="../../utils/logout.php">Cerrar Sesion</a>
      </li>
    </ul>
  </nav>
</header>