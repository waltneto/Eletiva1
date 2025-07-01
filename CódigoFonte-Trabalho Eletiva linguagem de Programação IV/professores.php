<?php
    require_once("cabecalho.php");

    function retornarProfessores(){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM professores";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e){
            die("Erro ao consultar professores: " . $e->getMessage());
        }
    }

    function adicionarProfessor($nome, $email, $cpf, $especializacao){
        require("conexao.php");
        try{
            $sql = "INSERT INTO professores (nome, email, cpf, especializacao) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $email, $cpf, $especializacao])){
                header('location: professores.php?cadastro=true');
            } else {
                header('location: professores.php?cadastro=false');
            }
        } catch (Exception $e){
            die("Erro ao adicionar professor: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $especializacao = $_POST['especializacao'];
        adicionarProfessor($nome, $email, $cpf, $especializacao);
    } else {
        $professores = retornarProfessores();
    }
?>

<h2>Gerenciar Professores</h2>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Professor cadastrado com sucesso!
    </div>
<?php elseif (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao cadastrar professor!
    </div>
<?php endif; ?>

<?php if (isset($_GET['edicao']) && $_GET['edicao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Professor alterado com sucesso!
    </div>
<?php elseif (isset($_GET['edicao']) && $_GET['edicao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao alterar professor!
    </div>
<?php endif; ?>

<?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Professor excluído com sucesso!
    </div>
<?php elseif (isset($_GET['exclusao']) && $_GET['exclusao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao excluir professor!
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarProfessor">
    Adicionar Novo Professor
</button>

<table class="table table-hover table-striped" id="tabela">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Especialização</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($professores as $professor): ?>
        <tr>
            <td><?= $professor['id'] ?></td>
            <td><?= $professor['nome'] ?></td>
            <td><?= $professor['email'] ?></td>
            <td><?= $professor['cpf'] ?></td>
            <td><?= $professor['especializacao'] ?></td>
            <td>
                <a href="editar_professor.php?id=<?= $professor['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_professor.php?id=<?= $professor['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                <a href="consultar_professor.php?id=<?= $professor['id'] ?>" class="btn btn-sm btn-danger">Excluir</a> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="modalAdicionarProfessor" tabindex="-1" aria-labelledby="modalAdicionarProfessorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarProfessorLabel">Adicionar Novo Professor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nome_professor" class="form-label">Nome</label>
                        <input type="text" id="nome_professor" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_professor" class="form-label">Email</label>
                        <input type="email" id="email_professor" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf_professor" class="form-label">CPF (Ex: 123.456.789-00)</label>
                        <input type="text" id="cpf_professor" name="cpf" class="form-control" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 123.456.789-00">
                    </div>
                    <div class="mb-3">
                        <label for="especializacao_professor" class="form-label">Especialização</label>
                        <input type="text" id="especializacao_professor" name="especializacao" class="form-control">
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