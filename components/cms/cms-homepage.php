<!-- Start Displayed Data Section -->
<article class="container">
  <article class="wrapper" id="data-display">
    <?php if (isset($_SESSION['notification'])) {
      include_once('../../components/notifications/notification-message.php');
    } ?>
    <div class="option-box" id="working-day-option">
      <a href="../staff/data-display.php?table=jornadas&query=active-working-day" class="option-box-link">
        <div class="option-box-header">
          <h2 class="option-mode-title">Jornadas del Dia</h2>
        </div>
        <div class="option-box-background"></div>
      </a>
    </div>
    <div class="option-box" id="boats-option">
      <a href="../staff/data-display.php?table=barcos&query=last-registered-boat" class="option-box-link">
        <div class="option-box-header">
          <h2 class="option-mode-title">Ult. Barco Registrado</h2>
        </div>
        <div class="option-box-background"></div>
      </a>
    </div>
    <div class="option-box" id="receipts-option">
      <a href="../staff/data-display.php?table=facturas&query=last-registered-receipt" class="option-box-link">
        <div class="option-box-header">
          <h2 class="option-mode-title">Ult. Factura Registrada</h2>
        </div>
        <div class="option-box-background"></div>
      </a>
    </div>

  </article>
</article>
<!-- End Displayed Data Section -->