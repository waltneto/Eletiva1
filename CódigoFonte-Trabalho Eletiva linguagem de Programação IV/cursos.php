<?php
    require_once("cabecalho.php");

    function retornarCursos(){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM cursos";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e){
            die("Erro ao consultar cursos: " . $e->getMessage());
        }
    }

    function adicionarCurso($nome, $descricao, $carga_horaria, $preco){
        require("conexao.php");
        try{
            $sql = "INSERT INTO cursos (nome, descricao, carga_horaria, preco) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $descricao, $carga_horaria, $preco])){
                header('location: cursos.php?cadastro=true');
            } else {
                header('location: cursos.php?cadastro=false');
            }
        } catch (Exception $e){
            die("Erro ao adicionar curso: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $carga_horaria = $_POST['carga_horaria'];
        $preco = $_POST['preco'];
        adicionarCurso($nome, $descricao, $carga_horaria, $preco);
    } else {
        $cursos = retornarCursos();
    }
?>

<h2>Gerenciar Cursos</h2>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Curso cadastrado com sucesso!
    </div>
<?php elseif (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao cadastrar curso!
    </div>
<?php endif; ?>

<?php if (isset($_GET['edicao']) && $_GET['edicao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Curso alterado com sucesso!
    </div>
<?php elseif (isset($_GET['edicao']) && $_GET['edicao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao alterar curso!
    </div>
<?php endif; ?>

<?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Curso excluído com sucesso!
    </div>
<?php elseif (isset($_GET['exclusao']) && $_GET['exclusao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao excluir curso!
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarCurso">
    Adicionar Novo Curso
</button>

<table class="table table-hover table-striped" id="tabela">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Carga Horária</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cursos as $curso): ?>
        <tr>
            <td><?= $curso['id'] ?></td>
            <td><?= $curso['nome'] ?></td>
            <td><?= $curso['carga_horaria'] ?>h</td>
            <td>R$ <?= number_format($curso['preco'], 2, ',', '.') ?></td>
            <td>
                <a href="editar_curso.php?id=<?= $curso['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_curso.php?id=<?= $curso['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                <a href="consultar_curso.php?id=<?= $curso['id'] ?>" class="btn btn-sm btn-danger">Excluir</a> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="modalAdicionarCurso" tabindex="-1" aria-labelledby="modalAdicionarCursoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarCursoLabel">Adicionar Novo Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="carga_horaria" class="form-label">Carga Horária (horas)</label>
                        <input type="number" id="carga_horaria" name="carga_horaria" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" step="0.01" id="preco" name="preco" class="form-control" required>
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