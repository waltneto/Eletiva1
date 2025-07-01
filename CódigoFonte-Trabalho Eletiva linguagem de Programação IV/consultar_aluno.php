<?php
    require_once("cabecalho.php");

    function consultaAluno($id){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM alunos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$aluno){
                die("Erro ao consultar o aluno!");
            } else{
                return $aluno;
            }
        } catch(Exception $e){
            die("Erro ao consultar aluno: " . $e->getMessage());
        }
    }

    // Função para excluir aluno, similar a excluirCategoria
    function excluirAluno($id){
        require("conexao.php");
        try{
            $sql = "DELETE FROM alunos WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])){
                header('location: alunos.php?exclusao=true');
            } else {
                header('location: alunos.php?exclusao=false');
            }
        } catch (Exception $e){
            die("Erro ao excluir o aluno: ".$e->getMessage());
        }
    }

    // Lógica para processar a requisição POST (excluir) ou GET (consultar)
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        excluirAluno($id);
    } else {
        $aluno = consultaAluno($_GET['id']);
    }
?>

<h2>Consultar Aluno</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $aluno['id'] ?>" >

    <div class="mb-3">
        <p>Nome: <b> <?= $aluno['nome'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> Email: <b> <?= $aluno['email'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> CPF: <b> <?= $aluno['cpf'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> Data de Nascimento: <b> <?= date('d/m/Y', strtotime($aluno['data_nascimento'])) ?> </b> </p>
    </div>

    <div class="mb-3">
        <p class="text-danger">Deseja excluir esse registro?</p>
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="alunos.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php
    require_once("rodape.php");
?>