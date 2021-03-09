<?php

session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['account_id'])) {
  header('location: ../../login/login.php');
}
switch ($_GET['table']) {
  case 'jornadas':
    require_once('../../models/WorkingDays.php');
    $query = new WorkingDay();
    $fileName = 'working-days.php';
    if (isset($_GET['query'])) {
      $response = $query->getActive();
    } else {
      if ($_SESSION['isAdmin']) {
        $response = $query->read();
      } else {
        $response = $query->getActive();
      }
    }
    break;
  case 'barcos':
    require_once('../../models/Boats.php');
    $query = new Boat();
    $fileName = 'boats.php';
    if (isset($_GET['query'])) {
      $response = $query->getLatest();
    } else {
      $response = $query->read();
    }
    break;
  case 'facturas':
    require_once('../../models/Receipts.php');
    $query = new Receipt();
    $fileName = 'receipts.php';
    if (isset($_GET['query'])) {
      $response = $query->getLatest();
    } else {
      if ($_SESSION['isAdmin']) {
        $response = $query->read();
      } else {
        $response = array($query->read($_SESSION['account_id']));
      }
    }
    break;
  case 'usuarios':
    require_once('../../models/User.php');
    $query = new User();
    if ($_SESSION['isAdmin']) {
      $fileName = 'users.php';
      $response = $query->read();
    } else {
      $response = array($query->read($_SESSION['account_id']));
    }
    break;
  default:
    return header('location: ../cms/cms.php');;
}

$db_headers = array();


for ($i = 2; $i < @sizeof($response[0]); $i += 2) {
  array_push($db_headers, array_keys($response[0])[$i]);
}
?>

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
      <?php if ($_SESSION['isAdmin']) { ?>
        <div class="wrapper">
          <a href="../admin/<?php echo $fileName;?>?action=create" class="button"><button value="Agregar Usuario" class="form-button"><i class="fas fa-user-plus"></i></button>
          </a>
        </div>
      <?php } ?>
      <article class="wrapper view-mode" id="data-display">
        <table>
          <thead>
            <tr>
              <?php
              foreach ($db_headers as $header) {
                echo '<th>' . $header . '</th>';
              }
              ?>
              <?php
              if ($_SESSION['isAdmin'] && sizeof($db_headers) > 0) {
                echo '<th>Modificar</th>';
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            if (@$response[0]) {
              foreach ($response as $data) {
                echo '<tr>';
                foreach ($db_headers as $header) {
                  if ($data[$header] == '') {
                    echo '<td>Sin Registrar</td>';
                  } else {
                    echo '<td>' . $data[$header] . '</td>';
                  }
                }
                if ($_SESSION['isAdmin']) {
                  echo '<td><a href="../admin/' . $fileName . '?action=update&id=' . $data['Id'] . '"><i class="far fa-edit"></i></a></td>';
                }
                echo '</tr>';
              }
            } else {
              echo '<tr>';
              echo '<td style="font-size:1.75rem;">No hay datos registrados</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </article>
    </article>
    <!-- End Displayed Data Section -->
  </main>
  <script src="../../assets/fontawesome/js/all.min.js"></script>
</body>

</html>