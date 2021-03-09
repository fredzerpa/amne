<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Head Meta Tags & Icons Links -->
    <?php require_once('../../components/cms/head/head.php') ?>

    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/cms/mode/view.css" />
    <title>CMS - AMNE</title>
  </head>
  <body>
    <!-- Start Header Section -->
    <?php require_once('../../components/cms/cms-header.php') ?>
    <!-- End Header Section -->

    <!-- Start Main Section -->
    <main>
      <!-- Start Side Bar Section -->
      <?php require_once('../../components/cms/cms-sidebar.php') ?>
      <!-- End Side Bar Section -->

      <!-- Start Displayed Data Section -->
      <article class="container">
        <article class="wrapper view-mode" id="data-display">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Nivel</th>
                <th>Modificar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Fred Zerpa</td>
                <td>24438839</td>
                <td>Pampatar</td>
                <td>04248570022</td>
                <td>fred@gmail.com</td>
                <td>ADMIN</td>
                <td>
                  <a href="#"><i class="far fa-edit"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </article>
      </article>
      <!-- End Displayed Data Section -->
    </main>
    <script src="../../assets/fontawesome/js/all.min.js"></script>
  </body>
</html>
