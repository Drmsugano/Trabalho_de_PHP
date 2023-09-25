<?php
include('../oculta_erros.php');
session_start();
$status = "Online";
if ($_SESSION['icon'] == "../../uploadUser/") {
  $_SESSION['icon'] = "../../uploadUser/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
  $_SESSION['icon'] = "../../uploadUser/IMG/user-circle-solid-48.png";
  $status = "Offline";
  $_SESSION['mensagem'] = "Ninguém está logado (<a href='PHP/login.php'>Clique aqui para logar</a>)";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Trabalho com BD</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php 
include ('../sidebars/sidebar_produtos.php');
?>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">Lojinha</span>
    </div>
    <?php 
      echo ("Em progresso ainda");
    ?>
  </section>
  <script src="../../JS/script.js"></script>
</body>

</html>