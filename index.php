<?php
include('PHP/oculta_erros.php');
session_start();
$status = "Online";
$conexao = mysqli_connect("localhost", "root", "", "trabalho") or die("Erro 1");
$produtos = mysqli_query($conexao, "select * from produto") or die("Erro 2");
if ($_SESSION['icon'] == "uploadUser/usuarios/") {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
  $status = "Offline";
  $_SESSION['mensagem'] = "Ninguém está logado (<a href='PHP/login.php'>Clique aqui para logar</a>)";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Trabalho com BD</title>
  <link rel="stylesheet" href="CSS/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body style ="background-color: #E4E9F7;">
  <?php
  include('PHP/sidebars/sidebar_index.php');
  ?>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">Lojinha</span>
    </div>
    <br>
    <div class="container">
      <?php
      include('PHP/carrossel.php')
        ?>
      <h5 class="text-center">Alguns de Nossos Produtos</h5>
      <br>
      <div class="row g-3">
        <?php
        while ($linhas = mysqli_fetch_array($produtos)) { ?>
          <div class="col md-6">
            <div class="card" style="width: 15rem;">
              <img src="<?= $linhas['png_produto'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">
                  <?= $linhas['nome'] ?>
                </h5>
                <p class="card-text">R$
                  <?= $linhas['preco'] ?>
                </p>
                <a href="#" class="btn btn-primary">Comprar</a>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </section>
  <script src="JS/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>