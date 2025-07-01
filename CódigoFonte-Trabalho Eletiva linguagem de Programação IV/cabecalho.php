<?php
  session_start();
  if(!$_SESSION['acesso']){
    header("location: index.php?mensagem=acesso_negado");
  }

  // Obter o nome do arquivo atual para destacar o botão ativo
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataforma de Cursos Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="principal.php">Plataforma de Cursos Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link btn-nav <?= ($current_page == 'cursos.php') ? 'active' : '' ?>" href="cursos.php">Cursos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-nav <?= ($current_page == 'alunos.php') ? 'active' : '' ?>" href="alunos.php">Alunos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-nav <?= ($current_page == 'professores.php') ? 'active' : '' ?>" href="professores.php">Professores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-nav <?= ($current_page == 'matriculas.php') ? 'active' : '' ?>" href="matriculas.php">Matrículas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-nav <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-nav <?= ($current_page == 'calculadora.php') ? 'active' : '' ?>" href="calculadora.php">Calculadora Exemplo</a>
            </li>
          </ul>
          <div class="d-flex">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['usuario'] ?>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="alterar_dados.php">Alterar Dados</a></li>
                <li><a class="dropdown-item btn btn-danger" href="sair.php" id="logoutButton">Sair</a></li>
              </ul>
            </li>
          </ul>
          </div>
        </div>
      </div>
    </nav>

    <main class="container">