<?php
    require_once("cabecalho.php");

    function retornarMatriculas(){
        require("conexao.php");
        try{
            $sql = "SELECT m.*, a.nome as nome_aluno, c.nome as nome_curso, p.nome as nome_professor
                        FROM matriculas m
                        INNER JOIN alunos a ON a.id = m.aluno_id
                        INNER JOIN cursos c ON c.id = m.curso_id
                        INNER JOIN professores p ON p.id = m.professor_id";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e){
            die("Erro ao consultar matrículas: " . $e->getMessage());
        }
    }

    function retornarAlunosDropdown(){
        require("conexao.php");
        try{
            $sql = "SELECT id, nome FROM alunos ORDER BY nome";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            die("Erro ao consultar alunos para dropdown: " . $e->getMessage());
        }
    }

    function retornarCursosDropdown(){
        require("conexao.php");
        try{
            $sql = "SELECT id, nome FROM cursos ORDER BY nome";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            die("Erro ao consultar cursos para dropdown: " . $e->getMessage());
        }
    }

    function retornarProfessoresDropdown(){
        require("conexao.php");
        try{
            $sql = "SELECT id, nome FROM professores ORDER BY nome";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            die("Erro ao consultar professores para dropdown: " . $e->getMessage());
        }
    }

    function adicionarMatricula($aluno_id, $curso_id, $professor_id){
        require("conexao.php");
        try{
            $sql = "INSERT INTO matriculas (aluno_id, curso_id, professor_id) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$aluno_id, $curso_id, $professor_id])){
                header('location: matriculas.php?cadastro=true');
            } else {
                header('location: matriculas.php?cadastro=false');
            }
        } catch (Exception $e){
            die("Erro ao adicionar matrícula: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $aluno_id = $_POST['aluno_id'];
        $curso_id = $_POST['curso_id'];
        $professor_id = $_POST['professor_id'];
        adicionarMatricula($aluno_id, $curso_id, $professor_id);
    } else {
        $matriculas = retornarMatriculas();
        $alunos_dropdown = retornarAlunosDropdown();
        $cursos_dropdown = retornarCursosDropdown();
        $professores_dropdown = retornarProfessoresDropdown();
    }
?>

<h2>Gerenciar Matrículas</h2>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Matrícula cadastrada com sucesso!
    </div>
<?php elseif (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao cadastrar matrícula!
    </div>
<?php endif; ?>

<?php if (isset($_GET['edicao']) && $_GET['edicao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Matrícula alterada com sucesso!
    </div>
<?php elseif (isset($_GET['edicao']) && $_GET['edicao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao alterar matrícula!
    </div>
<?php endif; ?>

<?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'true'): ?>
    <div class="alert alert-success mt-3 mb-3">
        Matrícula excluída com sucesso!
    </div>
<?php elseif (isset($_GET['exclusao']) && $_GET['exclusao'] == 'false'): ?>
    <div class="alert alert-danger mt-3 mb-3">
        Erro ao excluir matrícula!
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarMatricula">
    Registrar Nova Matrícula
</button>

<table class="table table-hover table-striped" id="tabela">
    <thead>
        <tr>
            <th>ID Matrícula</th>
            <th>Aluno</th>
            <th>Curso</th>
            <th>Professor</th>
            <th>Data da Matrícula</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($matriculas as $matricula): ?>
        <tr>
            <td><?= $matricula['id'] ?></td>
            <td><?= $matricula['nome_aluno'] ?></td>
            <td><?= $matricula['nome_curso'] ?></td>
            <td><?= $matricula['nome_professor'] ?></td>
            <td><?= date('d/m/Y H:i:s', strtotime($matricula['data_matricula'])) ?></td>
            <td>
                <a href="editar_matricula.php?id=<?= $matricula['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_matricula.php?id=<?= $matricula['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                <a href="consultar_matricula.php?id=<?= $matricula['id'] ?>" class="btn btn-sm btn-danger">Excluir</a> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="modalAdicionarMatricula" tabindex="-1" aria-labelledby="modalAdicionarMatriculaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarMatriculaLabel">Registrar Nova Matrícula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="aluno_id" class="form-label">Aluno</label>
                        <select id="aluno_id" name="aluno_id" class="form-select" required>
                            <option value="">Selecione um aluno</option>
                            <?php foreach ($alunos_dropdown as $aluno): ?>
                                <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="curso_id" class="form-label">Curso</label>
                        <select id="curso_id" name="curso_id" class="form-select" required>
                            <option value="">Selecione um curso</option>
                            <?php foreach ($cursos_dropdown as $curso): ?>
                                <option value="<?= $curso['id'] ?>"><?= $curso['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="professor_id" class="form-label">Professor</label>
                        <select id="professor_id" name="professor_id" class="form-select" required>
                            <option value="">Selecione um professor</option>
                            <?php foreach ($professores_dropdown as $professor): ?>
                                <option value="<?= $professor['id'] ?>"><?= $professor['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
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