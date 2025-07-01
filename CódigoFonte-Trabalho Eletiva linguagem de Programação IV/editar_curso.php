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

    function alterarCurso($nome, $descricao, $carga_horaria, $preco, $id){
        require("conexao.php");
        try{
            $sql = "UPDATE cursos SET nome = ?, descricao = ?, carga_horaria = ?, preco = ? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $descricao, $carga_horaria, $preco, $id])){
                header('location: cursos.php?edicao=true');
            } else {
                header('location: cursos.php?edicao=false');
            }
        } catch (Exception $e){
            die("Erro ao alterar o curso: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $carga_horaria = $_POST['carga_horaria'];
        $preco = $_POST['preco'];
        $id = $_POST['id'];
        alterarCurso($nome, $descricao, $carga_horaria, $preco, $id);
    } else {
        $curso = consultaCurso($_GET['id']);
    }
?>

<h2>Alterar Curso</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $curso['id'] ?>" >

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input value="<?= $curso['nome'] ?>" type="text" id="nome" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea id="descricao" name="descricao" class="form-control" rows="4" required><?= $curso['descricao'] ?></textarea>
    </div>

    <div class="mb-3">
        <label for="carga_horaria" class="form-label">Carga Horária (horas)</label>
        <input value="<?= $curso['carga_horaria'] ?>" type="number" id="carga_horaria" name="carga_horaria" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">Preço</label>
        <input value="<?= $curso['preco'] ?>" type="number" step="0.01" id="preco" name="preco" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <a href="cursos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
    require_once("rodape.php");
?>