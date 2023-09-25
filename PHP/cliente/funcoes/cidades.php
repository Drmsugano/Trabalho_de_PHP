<?php
$conexao = mysqli_connect("localhost", "root", "", "trabalho");
$id_estado = $_GET["id_estado"];
$resultado = mysqli_query($conexao,"select * from tb_cidades where id_estado = $id_estado order by nome_cidade");
while ($cidades = mysqli_fetch_array($resultado)) { ?>
    <select class="form-select sm" name="cidade" aria-label="select example" placeholder="Cidades">
        <option value="<?= $cidades["id_cidades"] ?>">
            <?= $cidades["nome_cidade"] ?>
        </option>
    </select>
<?php } ?>