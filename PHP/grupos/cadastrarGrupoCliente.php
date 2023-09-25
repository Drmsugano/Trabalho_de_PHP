<?php
include('../oculta_erros.php');
session_start();
$conexao = mysqli_connect("localhost", "root", "", "trabalho");
$status = "Online";
if ($_SESSION['icon'] == "uploadUser/usuarios/") {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
  $status = "Offline";
}
$grupo = mysqli_query($conexao, "select * from grupocliente");
if (isset($_POST["sql"])) {
  $nome = $_POST["nome"];
  $sql = "insert into grupocliente (nome_grupo) values ('$nome')";
  mysqli_query($conexao, $sql);
  $mensagem = "<br><div class='alert alert-primary' role='alert'>O grupo " . $nome . " foi cadastrado com sucesso.</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trabalho com BD</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <?php
  include('../sidebars/sidebar_grupos.php');
  ?>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">Cadastrar Grupo de Clientes</span>
    </div>
    <div class="container">
      <form method='post' enctype="multipart/form-data">
        <br>
        <h4 class="h4 mb-3 fw-normal">Insira os dados para o cadastro do grupo de Clientes</h4>
        <div class="mb-3">
          <div class="form-floating">
            <input type="text" name="nome" class="form-control" placeholder="Nome">
            <label for="floatingInput">Nome do Grupo</label>
          </div>
        </div>
        <div class="mb-3">
          <div class="checkbox mb-4">
            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="w-100 btn btn-lg btn-primary" name="sql" type="submit" onclick="sql">Cadastrar</button>
            </div>
          </div>
        </div>
        <?php 
        if (isset($_POST["sql"])){
          echo $mensagem;
        }
        ?>
    </form>
    <br>
    </div>
  </section>
  <script src="../../JS/script.js"></script>
</body>

</html>