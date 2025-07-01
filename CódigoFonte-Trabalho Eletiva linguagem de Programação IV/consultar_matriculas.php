<?php
    require_once("cabecalho.php");

    function consultaMatricula($id){
        require("conexao.php");
        try{
            $sql = "SELECT m.*, a.nome as nome_aluno, c.nome as nome_curso, p.nome as nome_professor
                        FROM matriculas m
                        INNER JOIN alunos a ON a.id = m.aluno_id
                        INNER JOIN cursos c ON c.id = m.curso_id
                        INNER JOIN professores p ON p.id = m.professor_id
                        WHERE m.id = ?";
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

    // Função para excluir matrícula, similar a excluirCategoria
    function excluirMatricula($id){
        require("conexao.php");
        try{
            $sql = "DELETE FROM matriculas WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])){
                header('location: matriculas.php?exclusao=true');
            } else {
                header('location: matriculas.php?exclusao=false');
            }
        } catch (Exception $e){
            die("Erro ao excluir a matrícula: ".$e->getMessage());
        }
    }

    // Lógica para processar a requisição POST (excluir) ou GET (consultar)
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        excluirMatricula($id);
    } else {
        $matricula = consultaMatricula($_GET['id']);
    }
?>

<h2>Consultar Matrícula</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $matricula['id'] ?>" >

    <div class="mb-3">
        <p>Aluno: <b> <?= $matricula['nome_aluno'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p>Curso: <b> <?= $matricula['nome_curso'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p>Professor: <b> <?= $matricula['nome_professor'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p>Data da Matrícula: <b> <?= date('d/m/Y H:i:s', strtotime($matricula['data_matricula'])) ?> </b> </p>
    </div>

    <div class="mb-3">
        <p class="text-danger">Deseja excluir esse registro?</p>
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="matriculas.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php
    require_once("rodape.php");
?>