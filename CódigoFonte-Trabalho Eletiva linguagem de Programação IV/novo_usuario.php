<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo Usuário - Plataforma de Cursos Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"> </head>
  <body class="container">
    <h1 class="mt-5">Cadastre-se</h1>

    <?php
        require_once('conexao.php'); // Inclui o arquivo de conexão com o banco de dados

        // Verifica se a requisição é POST para processar o formulário
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            try{
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $confirma_senha = $_POST['confirma_senha'];

                // Verifica se as senhas digitadas são iguais
                if ($senha !== $confirma_senha) {
                    $mensagem['erro'] = "As senhas não conferem!";
                } else {
                    // Hash da senha antes de salvar no banco de dados
                    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

                    // Prepara e executa a consulta SQL para inserir o novo usuário
                    $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');

                    if ($stmt->execute([$nome, $email, $senha_hash])){
                        $mensagem['sucesso'] = "Usuário cadastrado com sucesso! Você já pode <a href='index.php'>acessar</a>.";
                    } else {
                        $mensagem['erro'] = "Erro ao cadastrar usuário. Tente novamente.";
                    }
                }
            } catch(PDOException $e){
                // Verifica se o erro é de email duplicado (erro de chave única)
                if ($e->getCode() == '23000') { // Código SQLSTATE para violação de integridade (duplicate entry)
                    $mensagem['erro'] = "Este email já está cadastrado. Por favor, utilize outro email.";
                } else {
                    // Outros erros de banco de dados
                    $mensagem['erro'] = "Erro no banco de dados: ".$e->getMessage();
                }
            } catch(Exception $e){
                // Outros erros genéricos
                $mensagem['erro'] = "Erro: ".$e->getMessage();
            }
        }
    ?>

    <?php if (isset($mensagem['sucesso'])): ?>
        <div class="alert alert-success mt-3 mb-3">
            <?= $mensagem['sucesso'] ?>
        </div>
    <?php endif; ?>

    <?php if (isset($mensagem['erro'])): ?>
        <div class="alert alert-danger mt-3 mb-3">
            <?= $mensagem['erro'] ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome Completo</label>
                <input id="nome" name="nome" class="form-control" type="text" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" class="form-control" type="email" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input id="senha" name="senha" class="form-control" type="password" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="confirma_senha" class="form-label">Confirme a Senha</label>
                <input id="confirma_senha" name="confirma_senha" class="form-control" type="password" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a href="index.php" class="btn btn-secondary">Voltar ao Login</a>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>