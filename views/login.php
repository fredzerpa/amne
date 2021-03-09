<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Fred Z" />
    <meta
      name="description"
      content="Sistema de Facturacion automatizado para la empresa Alimentos Marinos de Nueva Esparta C.A. Para la gestión de los procesos de facturación, este sistema desarrolla un sistema que permite llevar un registro de las facturas generadas por los barcos que trabajan en cada jornada."
    />
    <!-- Favicons -->
    <link
      rel="icon"
      href="./assets/images/favicons/favicon-16x16.png"
      type="image/png"
      sizes="16x16"
    />
    <link
      rel="icon"
      href="./assets/images/favicons/favicon-32x32.png"
      type="image/png"
      sizes="32x32"
    />
    <link
      rel="icon"
      href="./assets/images/favicons/android-chrome-192x192.png"
      type="image/png"
      sizes="192x192"
    />
    <link
      rel="icon"
      href="./assets/images/favicons/android-chrome-512x512.png"
      type="image/png"
      sizes="512x512"
    />

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/main.css" />

    <title>Sistema de Facturacion - FZ</title>
  </head>
  <body>
    <body>
      <!-- Start Main Section -->
      <main>
        <!-- Logo -->
        <div id="logo" class="logo-container">
          <img class="" src="../assets/images/logo.png" alt="AMNE Logo" />
        </div>
        <!-- Page Title -->
        <h1 class="title">AMNE Co.</h1>
        <h3 class="description">Y tu, quieres vender tu pesca?</h3>
        <article class="container">
          <section id="login">
            <h3 class="section-title">Iniciar Sesion</h3>
            <form method="POST" action="">
              <div class="form-group">
                <input
                  type="text"
                  id="username"
                  name="username"
                  class="form-control"
                  placeholder="Usuario"
                  tabindex="1"
                  autofocus
                />
              </div>
              <br />
              <div class="form-group">
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="form-control"
                  placeholder="Clave"
                  tabindex="2"
                />
              </div>
              <div class="form-group">
                <input
                  type="submit"
                  value="Ingresar"
                  class="form-submit-button"
                  tabindex="3"
                />
              </div>
            </form>
          </section>
        </article>
      </main>
      <!-- End Main Section -->

      <!-- Start Footer Section -->
      <?php include_once('../components/footer.php') ?>
      <!-- End Footer Section -->

      <script src="../assets/fontawesome/js/all.min.js"></script>
    </body>
  </body>
</html>
