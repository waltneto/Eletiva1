<?php
    require_once("cabecalho.php");

    function consultaProfessor($id){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM professores WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $professor = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$professor){
                die("Erro ao consultar o professor!");
            } else{
                return $professor;
            }
        } catch(Exception $e){
            die("Erro ao consultar professor: " . $e->getMessage());
        }
    }

    // Função para excluir professor, similar a excluirCategoria
    function excluirProfessor($id){
        require("conexao.php");
        try{
            $sql = "DELETE FROM professores WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])){
                header('location: professores.php?exclusao=true');
            } else {
                header('location: professores.php?exclusao=false');
            }
        } catch (Exception $e){
            die("Erro ao excluir o professor: ".$e->getMessage());
        }
    }

    // Lógica para processar a requisição POST (excluir) ou GET (consultar)
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        excluirProfessor($id);
    } else {
        $professor = consultaProfessor($_GET['id']);
    }
?>

<h2>Consultar Professor</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $professor['id'] ?>" >

    <div class="mb-3">
        <p>Nome: <b> <?= $professor['nome'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> Email: <b> <?= $professor['email'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> CPF: <b> <?= $professor['cpf'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p> Especialização: <b> <?= $professor['especializacao'] ?> </b> </p>
    </div>

    <div class="mb-3">
        <p class="text-danger">Deseja excluir esse registro?</p>
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="professores.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php
    require_once("rodape.php");
?>