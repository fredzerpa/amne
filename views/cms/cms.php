<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Head Meta Tags & Icons Links -->
    <?php require_once('../../components/cms/head/head.php') ?>
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/cms/cms.css" />
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
        <article class="wrapper" id="data-display">
          <div class="option-box" id="working-day-option">
            <a href="./working-days.html?mode=view&search=today" class="option-box-link">
              <div class="option-box-header">
                <h2 class="option-mode-title">Jornada del Dia</h2>
              </div>
              <div class="option-box-background"></div>
            </a>
          </div>
          <div class="option-box" id="boats-option">
            <a href="./boats.html?mode=view&search=last" class="option-box-link">
              <div class="option-box-header">
                <h2 class="option-mode-title">Ult. Barco Registrado</h2>
              </div>
              <div class="option-box-background"></div>
            </a>
          </div>
          <div class="option-box" id="receipts-option">
            <a href="./receipts.html?mode=view&search=last" class="option-box-link">
              <div class="option-box-header">
                <h2 class="option-mode-title">Ult. Factura Registrada</h2>
              </div>
              <div class="option-box-background"></div>
            </a>
          </div>
          
        </article>
      </article>
      <!-- End Displayed Data Section -->
    </main>
    <script src="../../assets/fontawesome/js/all.min.js"></script>
  </body>
</html>
