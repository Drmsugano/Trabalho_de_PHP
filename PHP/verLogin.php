<?php
session_start();
$conexao= mysqli_connect("localhost","root","","trabalho");
$result_user = (mysqli_query($conexao,"select id_usuario from usuario where id_usuario = ".$_SESSION["id_user"]));
if (mysqli_fetch_array($result_user) > 0){ 
        $mensagem = "Bem vindo ".$_SESSION["nome"];
} else if (mysqli_fetch_array($result_user) == null) { ?>
        <script>alert("Você não possui a permissão para acessar esta pagina")</script>
        <?php header ('locale: ../../index.php') ?>
<?php } ?>