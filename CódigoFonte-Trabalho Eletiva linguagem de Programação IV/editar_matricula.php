<?php
    require_once("cabecalho.php");

    function consultaMatricula($id){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM matriculas WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $matricula = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$matricula){
                die("Erro ao consultar a matrícula!");
            } else{
                return $matricula;
            }
        } catch(Exception $e){
            die("Erro ao consultar matrícula: " . $e->getMessage());
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

    function alterarMatricula($aluno_id, $curso_id, $professor_id, $id){
        require("conexao.php");
        try{
            $sql = "UPDATE matriculas SET aluno_id = ?, curso_id = ?, professor_id = ? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$aluno_id, $curso_id, $professor_id, $id])){
                header('location: matriculas.php?edicao=true');
            } else {
                header('location: matriculas.php?edicao=false');
            }
        } catch (Exception $e){
            die("Erro ao alterar a matrícula: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $aluno_id = $_POST['aluno_id'];
        $curso_id = $_POST['curso_id'];
        $professor_id = $_POST['professor_id'];
        $id = $_POST['id'];
        alterarMatricula($aluno_id, $curso_id, $professor_id, $id);
    } else {
        $matricula = consultaMatricula($_GET['id']);
        $alunos_dropdown = retornarAlunosDropdown();
        $cursos_dropdown = retornarCursosDropdown();
        $professores_dropdown = retornarProfessoresDropdown();
    }
?>

<h2>Alterar Matrícula</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $matricula['id'] ?>" >

    <div class="mb-3">
        <label for="aluno_id" class="form-label">Aluno</label>
        <select id="aluno_id" name="aluno_id" class="form-select" required>
            <option value="">Selecione um aluno</option>
            <?php foreach ($alunos_dropdown as $aluno): ?>
                <option value="<?= $aluno['id'] ?>" <?= ($aluno['id'] == $matricula['aluno_id']) ? 'selected' : '' ?>>
                    <?= $aluno['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="curso_id" class="form-label">Curso</label>
        <select id="curso_id" name="curso_id" class="form-select" required>
            <option value="">Selecione um curso</option>
            <?php foreach ($cursos_dropdown as $curso): ?>
                <option value="<?= $curso['id'] ?>" <?= ($curso['id'] == $matricula['curso_id']) ? 'selected' : '' ?>>
                    <?= $curso['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="professor_id" class="form-label">Professor</label>
        <select id="professor_id" name="professor_id" class="form-select" required>
            <option value="">Selecione um professor</option>
            <?php foreach ($professores_dropdown as $professor): ?>
                <option value="<?= $professor['id'] ?>" <?= ($professor['id'] == $matricula['professor_id']) ? 'selected' : '' ?>>
                    <?= $professor['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <a href="matriculas.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
    require_once("rodape.php");
?>