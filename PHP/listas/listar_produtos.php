<?php
include('../oculta_erros.php');
if ($_SESSION['icon'] == "uploadUser/usuarios/") {
    $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
    $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
    $status = "Offline";
}
$conexao = mysqli_connect("localhost", "root", "", "trabalho");
$produto = mysqli_query($conexao, "select * from produto");
if (isset($_GET["id_produtos"])) { ?>
    <?php
    $id = $_GET["id_produtos"];
    $sql= "delete from produto where id = $id";
    mysqli_query($conexao,$sql) or die("Error"); ?>
    <script>alert('Exclusão Concluida com sucesso')</script>
    <?php
    header('refresh:0.5 listar_produtos.php');
  } ?>
<!DOCTYPE html>
<html lang="en">

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
</head>

<body style="background-color: #E4E9F7;">
    <?php
    include('../sidebars/sidebar_listas.php');
    ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Listas de Produtos</span>
        </div>
        <br>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5>Listagem de Produtos <a href="../produtos/cadastrar.php"
                            class="btn btn-primary">+</a></h5>
                </div>
            </div>
            <table class="table  table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID do Produto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Imagem do Produto</th>
                        <th scope="col">Unidade de Medida</th>
                        <th scope="col">Preco</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($linhas = mysqli_fetch_array($produto)) { ?>
                        <tr>
                            <td>
                                <?= $linhas['id'] ?>
                            </td>
                            <td>
                                <?= $linhas['nome'] ?>
                            </td>
                            <td>
                                <img src="../../<?= $linhas['png_produto'] ?>" width='50' height='60'>
                            </td>
                            <td>
                                <?= $linhas['unidadeDeMedida'] ?>
                            </td>
                            <td>
                                R$<?= $linhas['preco'] ?>
                            </td>
                            <td>
                                <?= $linhas['quantidade'] ?>
                            </td>
                            <td>
                                <a href='listar_produtos.php?id_produtos=<?= $linhas['id'] ?>' class='m-1 btn btn-danger'
                                    onclick="return confirm ('Confirma a Exclusão')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </section>
    <script src="../../JS/script.js"></script>
</body>

</html>