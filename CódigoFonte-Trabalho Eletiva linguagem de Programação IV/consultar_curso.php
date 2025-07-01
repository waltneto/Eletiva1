<?php
    require_once("cabecalho.php");

    function consultaCurso($id){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM cursos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $curso = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$curso){
                die("Erro ao consultar o curso!");
            } else{
                return $curso;
            }
        } catch(Exception $e){
            die("Erro ao consultar curso: " . $e->getMessage());
        }
    }

    // Função para excluir curso, similar a excluirCategoria
    function excluirCurso($id){
        require("conexao.php");
        try{
            $sql = "DELETE FROM cursos WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])){
                header('location: cursos.php?exclusao=true');
            } else {
                header('location: cursos.php?exclusao=false');
            }
        } catch (Exception $e){
            die("Erro ao excluir o curso: ".$e->getMessage());
        }
    }

    // Lógica para processar a requisição POST (excluir) ou GET (consultar)
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        excluirCurso($id);
    } else {
        $curso = consultaCurso($_GET['id']);
    }
?>

<h2>Consultar Curso</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $curso['id'] ?>" >

    <div class="mb-3">
        <p>Nome: <b> <?= $curso['nome'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> Descrição: <b> <?= $curso['descricao'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> Carga Horária: <b> <?= $curso['carga_horaria'] ?>h </b> </p>
    </div>

    <div class="mb-3">
        <p> Preço: <b> R$ <?= number_format($curso['preco'], 2, ',', '.') ?> </b> </p>
    </div>

    <div class="mb-3">
        <p class="text-danger">Deseja excluir esse registro?</p>
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="cursos.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php
    require_once("rodape.php");
?>