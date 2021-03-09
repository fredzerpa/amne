<?php
session_start();

if (isset($_SESSION['usuario']) || isset($_SESSION['account_id'])) {
  header('location: ../cms/cms.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once('../../components/cms/head/head.php') ?>

  <!-- CSS -->
  <link rel="stylesheet" href="../../assets/css/main.css" />

  <title>Sistema de Facturacion - FZ</title>
</head>

<body>

  <body>
    <!-- Start Main Section -->
    <main>
      <!-- Logo -->
      <div id="logo" class="logo-container">
        <img class="" src="../../assets/images/logo.png" alt="AMNE Logo" />
      </div>
      <!-- Page Title -->
      <h1 class="title">AMNE Co.</h1>
      <h3 class="description">Y tu, quieres vender tu pesca?</h3>
      <article class="container">
        <section id="login">
          <?php if (isset($_SESSION['notification'])) {
            include_once('../../components/notifications/notification-message.php');
          } ?>
          <h3 class="section-title">Iniciar Sesion</h3>
          <form method="POST" action="../../controllers/AuthControllers.php">
            <div class="form-group">
              <input type="text" id="username" name="username" class="form-control" placeholder="Usuario" tabindex="1" autofocus required />
            </div>
            <br />
            <div class="form-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Clave" tabindex="2" required />
            </div>
            <div class="form-group">
              <input type="submit" value="Ingresar" class="form-submit-button" tabindex="3" />
            </div>
          </form>
        </section>
      </article>
    </main>
    <!-- End Main Section -->

    <!-- Start Footer Section -->
    <?php include_once('../../components/footer.php') ?>
    <!-- End Footer Section -->

    <script src="../../assets/fontawesome/js/all.min.js"></script>
  </body>
</body>

</html>