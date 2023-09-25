<?php
include('../oculta_erros.php');
session_start();
$status = "Online";
$conexao = mysqli_connect("localhost", "root", "", "trabalho");
$result_grupo = mysqli_query($conexao, "select * from grupocliente");
$result_estado = mysqli_query($conexao, "select * from tb_estados");
if ($_SESSION['icon'] == "uploadUser/usuarios/") {
    $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
}
if ($_SESSION['nome'] == null) {
    $_SESSION['icon'] = "uploadUser/usuarios/IMG/user-circle-solid-48.png";
    $status = "Offline";
    $_SESSION['mensagem'] = "Ninguém está logado (<a href='PHP/login.php'>Clique aqui para logar</a>)";
}
if (isset($_POST['mysql'])) {
    $status = $_POST["status"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $grupo = $_POST["grupo"];
    $cpfcnpj = $_POST["cpf_cnpj"];
    $telefone = $_POST["telefone"];
    $cep = $_POST["cep"];
    $endereco = $_POST["endereco"];
    $numero = $_POST["numero"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $result_email = (mysqli_query($conexao, "select email from cliente where email = '$email'"));
    if (mysqli_fetch_array($result_email) > 0) {
        $mensagem = "<br><div class='alert alert-danger' role='alert'>E-mail já cadastrado no banco de dados</div>";
        $login = null;
    } else {
        if (isset($_FILES["png_perfil"]) && !empty($_FILES["png_perfil"])) {
            $diretorio = "../../uploadUser/clientes/" . $_FILES["png_perfil"]["name"];
            move_uploaded_file($_FILES["png_perfil"]["tmp_name"], $diretorio);
            $diretorio = "uploadUser/clientes/" . $_FILES["png_perfil"]["name"];
        }
        $sql = mysqli_query($conexao, "update cliente set nome = '$_POST[nome]' ,email = '$_POST[email]', id_grupo_cliente = '$_POST[grupo]', cpfcnpj= '$_POST[cpf_cnpj]', telefone = '$_POST[telefone]', cep= '$_POST[cep]', endereco= '$_POST[endereco]', numero= '$_POST[numero]', id_estado = '$_POST[estado]', id_cidade= '$_POST[cidade]', png_cliente = '$diretorio', status= '$_POST[status]' where id_cliente = $_GET[id]") or die("Falha na Execução 3");
        $mensagem = "<br><div class='alert alert-primary' role='alert'>O(a) cliente " . $nome . " foi alterado(a) com sucesso.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include('../sidebars/sidebar_clientes.php');
    ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Alteração de Dados Clientes</span>
        </div>
        <div class="container">
            <form method='post' enctype="multipart/form-data">
                <br>
                <h1 class="h3 mb-3 fw-normal">Insira os dados para a Alteração do Cliente</h1>
                <div class="mb-3">
                    <label for="floatingInput">Foto de Perfil</label>
                    <input type="file" name="png_perfil" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <div class="row g-3">
                        <div class="col mb-3">
                            <select class="form-select form-select-sm" name="status" aria-label="Small select example"
                                required>
                                <option selected>Selecione a Situação do Cliente</option>
                                <option value="S">Ativo</option>
                                <option value="N">Inativo</option>
                            </select>
                        </div>
                        <div class="col md-3">
                            <div class="form-floating">
                                <input type="text" name="nome" class="form-control" placeholder="Nome">
                                <label for="floatingInput">Nome</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <select class="form-select" name="grupo" aria-label="select example"
                                placeholder="Grupo de Usuario">
                                <option selected>Grupo de Clientes</option>
                                <?php
                                while ($grupos = mysqli_fetch_array($result_grupo)) { ?>
                                    <option value="<?= $grupos['id_grupo_cliente'] ?>">
                                        <?= $grupos['nome_grupo'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="floatingSelect"><a href="../grupos/cadastrarGrupoUser.php">Cadastrar Novo
                                    Grupo</a></label>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <div class="mb">
                                <div class="form-floating">
                                    <input type="text" name="cpf_cnpj" id="cpfcnpj" class="form-control"
                                        placeholder="CPF/CNPJ" maxlength="15">
                                    <label for="floatingInput">CPF/CNPJ</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" id="telefone" name="telefone" class="form-control"
                                        maxlength="15">
                                    <label for="floatingInput">Telefone com (DDD)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" id="cep" name="cep" class="form-control" maxlength="10">
                                    <label for="floatingInput">CEP</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="endereco" class="form-control">
                                    <label for="floatingInput">Endereço</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="numero" class="form-control">
                                    <label for="floatingInput">Numero da Casa/Apartamento</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="row g-3">
                            <div class="col">
                                <select class="form-select sm" name="estado" aria-label="select example"
                                    placeholder="Estados" id="id_estado">
                                    <option selected>Estados</option>
                                    <?php
                                    while ($estados = mysqli_fetch_array($result_estado)) { ?>
                                        <option value="<?= $estados['id_estado'] ?>">
                                            <?= $estados['uf'] . ', ' . $estados['nome_estado'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select sm" name="cidade" aria-label="select example"
                                    placeholder="cidades" id="id_cidade">
                                    <option value="">Escolha um Estado</option>
                                </select>
                            </div>
                        </div>
                        <div class="checkbox mb-4">
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" name="mysql" type="submit"
                            onclick="mysql">Alterar</button>
                        <div class="mb-4">
                            <?php
                            if (isset($_POST["mysql"])) {
                                echo $mensagem;
                            }
                            ?>
                        </div>
                    </div>
            </form>
        </div>
    </section>
    <script type="text/javascript" src="../../JS/script.js"></script>
    <script type="text/javascript" src="../../JS/jquery.mask.js"></script>
    <script type="text/javascript" src="funcoes/cidades.js"></script>
    <script type="text/javascript" src="funcoes/mascaras.js"></script>
</body>

</html>