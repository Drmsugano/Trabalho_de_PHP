<?php
session_start();
include("../oculta_erros.php");
$conexao = mysqli_connect("localhost", "root", "", "trabalho") or die("Erro 1");
$status = "Online";
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
    $preco = $_POST["preco"];
    $unidade_medida = $_POST["unidade"];
    $quantidade = $_POST["quantidade"];
        if (isset($_FILES["png_produto"]) && !empty($_FILES["png_produto"])) {
            $diretorio = "../../uploadUser/produtos/" . $_FILES["png_produto"]["name"];
            move_uploaded_file($_FILES["png_produto"]["tmp_name"], $diretorio);
            $diretorio = "uploadUser/produtos/" . $_FILES["png_produto"]["name"];
        }
        $sql = mysqli_query($conexao, "insert into produto (nome, preco, unidadeDeMedida, png_produto, quantidade) values ('$nome', '$preco', '$unidade_medida', '$diretorio','$quantidade')") or die("Erro 3");
        $mensagem = "<br><div class='alert alert-primary' role='alert'>O Produto " . $nome . " foi cadastrado com sucesso.</div>";
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include('../sidebars/sidebar_produtos.php');
    ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Cadastrar Produtos</span>
        </div>
        <div class="container">
            <form method='post' enctype="multipart/form-data">
                <br>
                <h1 class="h3 mb-3 fw-normal">Insira os dados para o cadastro de Produtos</h1>
                <div class="mb-3">
                    <label for="floatingInput">Foto do Produto</label>
                    <input type="file" name="png_produto" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="nome" class="form-control" placeholder="Nome">
                        <label for="floatingInput">Nome</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="preco" id="dinheiro" class="form-control dinheiro">
                        <label for="floatingInput">Preço em (BRL)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="unidade" class="form-control">
                                <label for="floatingInput">Unidade de Medida</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="number" name="quantidade" class="form-control">
                                <label for="floatingInput">Quantidade</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkbox mb-4">
                </div>
                <button class="w-100 btn btn-lg btn-primary" name="mysql" type="submit"
                    onclick="mysql">Cadastrar</button>
                <div class="mb-4">
                    <?php
                    if (isset($_POST["mysql"])) {
                        echo $mensagem;
                    }
                    ?>
                </div>
        </div>
        </form>
    </section>
    <script type="text/javascript" src="../../JS/jquery.mask.js"></script>
    <script src="funcoes/mascara.js"></script>
    <script src="../../JS/script.js"></script>
</body>

</html>