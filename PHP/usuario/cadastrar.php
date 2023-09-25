<?php
include("../oculta_erros.php");
session_start();
$conexao = mysqli_connect("localhost", "root", "", "trabalho");
$status = "Online";
$verifica_grupo = (mysqli_query($conexao, "select * from grupousuario"));
$result_grupo = (mysqli_query($conexao, "select * from grupousuario"));
if (mysqli_fetch_array($verifica_grupo) == 0) { ?>
  <script>alert("Cadastre um Grupo Primeiro para Cadastrar um usuario")</script>
  <?php header("refresh: 0.5 ../grupos/cadastrarGrupoUser.php");
}
if ($_SESSION['icon'] == "uploadUser/usuarios/") {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
  $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
  $status = "Offline";
  $_SESSION['mensagem'] = "Ninguém está logado (<a href='PHP/login.php'>Clique aqui para logar</a>)";
}
if (isset($_POST['mysql'])) {
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $grupo = $_POST["grupo"];
  $result_email = (mysqli_query($conexao, "select email from usuario where email = '$email'"));
  $result_nome = (mysqli_query($conexao, "select nome from usuario where nome = '$nome'"));
  if (mysqli_fetch_array($result_nome) > 0) {
    $mensagem = "<br><div class='alert alert-danger' role='alert'>Nome de Usuario já cadastrado no banco de dados</div>";
    $login = null;
  } else if (mysqli_fetch_array($result_email) > 0) {
    $mensagem = "<br><div class='alert alert-danger' role='alert'>E-mail já cadastrado no banco de dados</div>";
    $login = null;
  } else {
    if (isset($_FILES["png_perfil"]) && !empty($_FILES["png_perfil"])) {
      $diretorio = "../../uploadUser/usuarios/" . $_FILES["png_perfil"]["name"];
      move_uploaded_file($_FILES["png_perfil"]["tmp_name"], $diretorio);
      $diretorio = "uploadUser/usuarios/" . $_FILES["png_perfil"]["name"];
    }
    $sql = mysqli_query($conexao, "insert into usuario (nome, email, senha, png_perfil, id_grupo_usuario) values ('$nome', '$email', '$senha', '$diretorio','$grupo')") or die("Falha na Execução");
    $mensagem = "<br><div class='alert alert-primary' role='alert'>O usuário " . $nome . " foi cadastrado com sucesso.</div>";
    $login = "<div class = 'checkbox mb-4'> <button class= 'w-100 btn btn-lg btn-primary' name = 'confirmar' type='submit'>Ir para login</button></div>";
  }
}
if (isset($_POST['confirmar'])) {
  header("Location: login.php");
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
  include('../sidebars/sidebar_usuario.php');
  ?>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">Cadastrar Usuario</span>
    </div>
    <div class="container">
      <form method='post' enctype="multipart/form-data">
        <br>
        <h1 class="h3 mb-3 fw-normal">Insira os dados para o cadastro do Funcionario</h1>
        <div class="mb-3">
          <label for="floatingInput">Foto de Perfil</label>
          <input type="file" name="png_perfil" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <div class="form-floating">
                <input type="text" name="nome" class="form-control" placeholder="Nome">
                <label for="floatingInput">Nome</label>
              </div>
            </div>
            <div class="col">
              <select class="form-select" name="grupo" aria-label="select example" placeholder="Grupo de Usuario" required>
                <option selected>Grupo de Usuario</option>
                <?php
                while ($grupos = mysqli_fetch_array($result_grupo)) { ?>
                  <option value="<?= $grupos['id_grupo_usuario'] ?>">
                    <?= $grupos['nome_grupo'] ?>
                  </option>
                <?php } ?>
              </select>
              <label for="floatingSelect"><a href="../grupos/cadastrarGrupoUser.php">Cadastrar Novo Grupo</a></label>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="form-floating">
            <input type="email" name="email" class="form-control" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
          </div>
        </div>
        <div class="mb-3">
          <div class="form-floating">
            <input type="password" name="senha" class="form-control" placeholder="Password">
            <label for="floatingPassword">Senha</label>
          </div>
        </div>
        <div class="checkbox mb-4">
        </div>
        <button class="w-100 btn btn-lg btn-primary" name="mysql" type="submit" onclick="mysql">Cadastrar</button>
        <div class="mb-4">
          <?php
          if (isset($_POST["mysql"])) {
            echo $mensagem;
            echo $login;
          }
          ?>
        </div>
    </div>
    </form>
  </section>
  <script src="../../JS/script.js"></script>
</body>

</html>