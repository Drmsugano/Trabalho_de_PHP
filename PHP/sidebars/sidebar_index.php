<!--SIDEBAR DA PARTE DA PAGINA PRINCIPAL !-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar-index</title>
</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <a href="../../index.php">
        <i class='bx bx-game'></i>
      </a>
      <span class="logo_name">Lojinha</span>
    </div>
    <ul class="nav-links">
      <li>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Usuario</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-user'></i>
            <span class="link_name">Usuario</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Usuario</a></li>
          <li><a href="PHP/usuario/cadastrar.php">Cadastrar</a></li>
          <li><a href="PHP/usuario/login.php">Login</a></li>
          <?php
          if ($_SESSION["nome"] != null) { ?>
            <li><a href='PHP/logout.php'>Logout</a></li>
          <?php } ?>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
          <i class='bx bxs-contact'></i>
            <span class="link_name">Clientes</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="">Clientes</a></li>
          <li><a href="PHP/cliente/cadastrar.php">Cadastrar</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-list-ul'></i>
            <span class="link_name">Listas</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Listas</a></li>
          <li><a href="PHP/listas/listar_usuarios.php">Usuarios</a></li>
          <li><a href='PHP/listas/listar_produtos.php'>Produtos</a></li>
          <li><a href='PHP/listas/listar_clientes.php'>Clientes</a></li>
          <li><a href='PHP/listas/listar_gruposUser.php'>Grupos de Usuarios</a></li>
          <li><a href='PHP/listas/listar_gruposCliente.php'>Grupos de Clientes</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-group'></i>
            <span class="link_name">Grupos</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="">Cadastros</a></li>
          <li><a href="PHP/grupos/cadastrarGrupoUser.php">Grupo de Usuarios</a></li>
          <li><a href='PHP/grupos/cadastrarGrupoCliente.php'>Grupo de Clientes</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-shopping-bag'></i>
            <span class="link_name">Produtos</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Produtos</a></li>
            <li><a href="PHP/produtos/cadastrar.php">Cadastrar Produtos</a></li>
          <li><a href="PHP/produtos/catalogo.php">Explorar</a></li>
        </ul>
      </li>
      <li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li>
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="<?= $_SESSION["icon"]; ?>" alt="profileImg">
          </div>
          <div class="name-job">
            <?php
            if ($_SESSION["nome"] == null) { ?>
              <div class='profile_name'>Sem Login</div>
              <div class='job'>
                <?= $status ?>
              </div>
            <?php } else { ?>
              <div class='profile_name'>
                <?= $_SESSION["nome"] ?>
              </div>
              <div class='job'>
                <?= $status ?>
              </div>
            <?php } ?>
          </div>
          <a href="PHP/logout.php"><i class='bx bx-log-out'></i></a>
        </div>
      </li>
    </ul>
  </div>
</body>

</html>