<?php
include('../oculta_erros.php');
session_start();
$status = "Online";
if ($_SESSION['icon'] == "uploadUser/usuarios/") {
    $_SESSION['icon'] = "uploadUser/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
    $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
    $status = "Offline";
    $_SESSION['mensagem'] = "Ninguém está logado (<a href='PHP/login.php'>Clique aqui para logar</a>)";
}
$conexao = mysqli_connect("localhost", "root", "", "trabalho");
$result_status = mysqli_query($conexao, "select status from cliente");
$sql = "select *, grupocliente.nome_grupo, tb_estados.nome_estado, tb_cidades.nome_cidade from cliente inner join grupocliente on grupocliente.id_grupo_cliente = cliente.id_grupo_cliente inner join tb_estados on tb_estados.id_estado = cliente.id_estado inner join tb_cidades on tb_cidades.id_cidades = cliente.id_cidade";
$resultado = mysqli_query($conexao, $sql);
if (isset($_GET["id"])) { ?>
    <?php
    $id = $_GET["id"];
    $sql = "delete from cliente where id_cliente = " . $id;
    mysqli_query($conexao, $sql); ?>
    <script>alert('Exclusão Concluida com sucesso')</script>
    <?php
    header('refresh:0.5 listar_clientes.php');
} ?>
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
    include('../sidebars/sidebar_listas.php');
    ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>
        <div class=" mb-3 container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5>Listagem de Clientes <a href="../cliente/cadastrar.php" class="btn btn-primary">+</a></h5>
                    </p>
                </div>
            </div>
        <div id="listas">
            <div class="table-responsive ">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Email</th>
                            <th scope="col">CPF/CNPJ</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">CEP</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Numero</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Foto de Perfil</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php while ($linhas = mysqli_fetch_array($resultado)) { ?>
                                <tr>
                                    <td>
                                        <?= $linhas['id_cliente'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['nome'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['nome_grupo'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['email'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['cpfcnpj'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['telefone'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['cep'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['endereco'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['numero'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['nome_estado'] ?>
                                    </td>
                                    <td>
                                        <?= $linhas['nome_cidade'] ?>
                                    </td>
                                    <td class="text-center">
                                        <img src=../../<?= $linhas['png_cliente'] ?> width='40' height='40'>
                                    </td>
                                    <td>
                                        <?= $linhas['status'] ?>
                                    </td>
                                    <td>
                                        <a href='../cliente/alterar.php?id=<?= $linhas['id_cliente'] ?>'
                                            class='btn btn-warning'>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                            <a href='listar_clientes.php?id=<?= $linhas['id_cliente'] ?>'
                                                class='m-1 btn btn-danger' onclick="return confirm ('Confirma a Exclusão')">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
                    </div>
                </table>
            </div>
        </div>
    </section>
    <script src="../../JS/script.js"></script>
    <script src="funcoes/funcoes_status.js"></script>
</body>

</html>