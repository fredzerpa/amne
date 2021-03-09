<?php

if (isset($_SESSION['notification'])) {
  $title = $_SESSION['notification_title'];
  $message = $_SESSION['notification_message'];

  if ($_GET['error']) {
    $class_name = 'error';
  } else if ($_GET['success']) {
    $class_name = 'success';
  }
?>
  <div id="notification-box" class="<?php echo $class_name; ?>">
    <h3 id="notification-title"><?php echo $title ?>:</h3>
    <p id="notification-description"><?php echo $message ?></p>
  </div>

<?php } ?>