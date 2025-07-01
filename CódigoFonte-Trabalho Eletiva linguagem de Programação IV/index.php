<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Gerenciamento de Cursos Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"> </head>
  <body class="container">
    <h1 class="mt-5">Sistema de Controle de Gerenciamento de Cursos Online</h1>

    <?php
        require_once('conexao.php');
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            try{
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?'); // Corrigido para 'usuarios'
                $stmt->execute([$email]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($usuario && password_verify($senha, $usuario['senha'])){
                    session_start();
                    $_SESSION['usuario'] = $usuario['nome'];
                    $_SESSION['acesso'] = true;
                    $_SESSION['id'] = $usuario['id'];
                    header('location: principal.php');
                } else {
                    $mensagem['erro'] = "Usuário e/ou senha incorretos!";
                }
            } catch(Exception $e){
                echo "Erro: ".$e->getMessage();
                die();
            }
        }
    ?>

    <?php if (isset($mensagem['erro'])): ?>
        <div class="alert alert-danger mt-3 mb-3">
            <?= $mensagem['erro'] ?>
        </div>
    <?php endif; ?>

    <?php
        if ((isset($_GET['mensagem'])) && ($_GET['mensagem'] == "acesso_negado")): ?>
        <div class="alert alert-danger mt-3 mb-3">
            Você precisa informar seus dados de acesso para acessar o sistema!
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="row">
            <div class="col">
                <label for="email" class="form-label">Informe o email</label>
                <input id="email" name="email" class="form-control" type="email">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="senha" class="form-label">Informe a senha</label>
                <input id="senha" name="senha" class="form-control" type="password">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary mt-3">Acessar</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Não possui acesso? Clique <a href="novo_usuario.php">aqui</a>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>