<?php
include('../oculta_erros.php');
session_start();
$status = "Online";
if ($_SESSION['icon'] == "uploadUser/usuarios/") {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
  $status = "Offline";
  $_SESSION['mensagem'] = "Ninguém está logado (<a href='PHP/login.php'>Clique aqui para logar</a>)";
}
$conexao = mysqli_connect("localhost", "root", "", "trabalho");
$result = mysqli_query($conexao, "select * from usuario where nome = '$_POST[nome]' and senha = '$_POST[senha]'");
while ($linha = mysqli_fetch_array($result)) {
  $_SESSION["id"] = $linha["id"];
  $_SESSION["icon"] = $linha["png_perfil"];
  $_SESSION["email"] = $linha["email"];
}
if (isset($_POST['cadastrar'])) {
  header('location: cadastrar.php');
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
 include ('../sidebars/sidebar_usuario.php');
 ?>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">Lojinha</span>
    </div>
    <div class="container">
      <form method='post'>
        <br>
        <h1 class="h3 mb-3 fw-normal">Insira os dados</h1>
        <div class="mb-3">
          <div class="form-floating">
            <input type="text" name="nome" class="form-control" placeholder="Seu Usuario" require>
            <label for="floatingInput">Usuario
          </div>
        </div>
        <div class="mb-3">
          <div class="form-floating">
            <input type="password" name="senha" class="form-control" placeholder="Password" require>
            <label for="floatingPassword">Senha</label>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="checkbox mb-4">
              <button class="w-100 btn btn-lg btn-primary" name="login" type="submit" onclick="">Entrar</button>
            </div>
          </div>
          <div class="col">
          </div>
          <div class="col">
            <div class="checkbox mb-4">
              <button class="w-100 btn btn-lg btn-success" name="cadastrar" type="submit"
                onclick="">Cadastra-se</button>
            </div>
          </div>
        </div>
        <?php
        if (isset($_POST['login'])) {
          $nome = $_POST['nome'];
          $senha = $_POST['senha'];
          $result = (mysqli_query($conexao, "select * from usuario where nome = '$nome' and senha = '$senha'"));
          if (mysqli_fetch_array($result) > 0) {
            $_SESSION["nome"] = $nome;
            $_SESSION["senha"] = $senha;
            $mensagem = "O usuario foi logado com sucesso";
            echo "<div class='alert alert-success' role='alert'>
          $mensagem <div class='spinner-border float-end'>
          </div>
          </div>";
            header('refresh:1.5 ../../index.php');
            $mensagem = $_SESSION['mensagem'] = "Bem vindo " . $_SESSION['nome'] . " do id = " . $_SESSION['id'];
          } else {
            unset($_SESSION["nome"]);
            unset($_SESSION["senha"]);
            $mensagem = "Usuario ou a Senha está invalido";
            echo "<div class='alert alert-danger' role='alert'>
            $mensagem
            </div>";
          }
        }
        ?>
      </form>
    </div>
    </div>
  </section>
  <script src="../../JS/script.js"></script>
</body>

</html>