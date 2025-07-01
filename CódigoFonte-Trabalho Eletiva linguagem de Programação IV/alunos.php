<?php
    require_once("cabecalho.php");

    function retornarAlunos(){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM alunos";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e){
            die("Erro ao consultar alunos: " . $e->getMessage());
        }
    }

    function adicionarAluno($nome, $email, $cpf, $data_nascimento){
        require("conexao.php");
        try{
            $sql = "INSERT INTO alunos (nome, email, cpf, data_nascimento) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $email, $cpf, $data_nascimento])){
                header('location: alunos.php?cadastro=true');
            } else {
                header('location: alunos.php?cadastro=false');
            }
        } catch (Exception $e){
            die("Erro ao adicionar aluno: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $data_nascimento = $_POST['data_nascimento'];
        adicionarAluno($nome, $email, $cpf, $data_nascimento);
    } else {
        $alunos = retornarAlunos();
    }
?>

<h2>Gerenciar Alunos</h2>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Aluno cadastrado com sucesso!
    </div>
<?php elseif (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao cadastrar aluno!
    </div>
<?php endif; ?>

<?php if (isset($_GET['edicao']) && $_GET['edicao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Aluno alterado com sucesso!
    </div>
<?php elseif (isset($_GET['edicao']) && $_GET['edicao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao alterar aluno!
    </div>
<?php endif; ?>

<?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Aluno excluído com sucesso!
    </div>
<?php elseif (isset($_GET['exclusao']) && $_GET['exclusao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao excluir aluno!
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarAluno">
    Adicionar Novo Aluno
</button>

<table class="table table-hover table-striped" id="tabela">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?= $aluno['id'] ?></td>
            <td><?= $aluno['nome'] ?></td>
            <td><?= $aluno['email'] ?></td>
            <td><?= $aluno['cpf'] ?></td>
            <td><?= date('d/m/Y', strtotime($aluno['data_nascimento'])) ?></td>
            <td>
                <a href="editar_aluno.php?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_aluno.php?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                <a href="consultar_aluno.php?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-danger">Excluir</a> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="modalAdicionarAluno" tabindex="-1" aria-labelledby="modalAdicionarAlunoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarAlunoLabel">Adicionar Novo Aluno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nome_aluno" class="form-label">Nome</label>
                        <input type="text" id="nome_aluno" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_aluno" class="form-label">Email</label>
                        <input type="email" id="email_aluno" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf_aluno" class="form-label">CPF (Ex: 123.456.789-00)</label>
                        <input type="text" id="cpf_aluno" name="cpf" class="form-control" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 123.456.789-00">
                    </div>
                    <div class="mb-3">
                        <label for="data_nascimento_aluno" class="form-label">Data de Nascimento</label>
                        <input type="date" id="data_nascimento_aluno" name="data_nascimento" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once("rodape.php");
?>