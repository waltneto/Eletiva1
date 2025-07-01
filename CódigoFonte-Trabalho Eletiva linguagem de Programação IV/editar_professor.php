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

    function alterarProfessor($nome, $email, $cpf, $especializacao, $id){
        require("conexao.php");
        try{
            $sql = "UPDATE professores SET nome = ?, email = ?, cpf = ?, especializacao = ? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $email, $cpf, $especializacao, $id])){
                header('location: professores.php?edicao=true');
            } else {
                header('location: professores.php?edicao=false');
            }
        } catch (Exception $e){
            die("Erro ao alterar o professor: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $especializacao = $_POST['especializacao'];
        $id = $_POST['id'];
        alterarProfessor($nome, $email, $cpf, $especializacao, $id);
    } else {
        $professor = consultaProfessor($_GET['id']);
    }
?>

<h2>Alterar Professor</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $professor['id'] ?>" >

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input value="<?= $professor['nome'] ?>" type="text" id="nome" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input value="<?= $professor['email'] ?>" type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF (Ex: 123.456.789-00)</label>
        <input value="<?= $professor['cpf'] ?>" type="text" id="cpf" name="cpf" class="form-control" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 123.456.789-00">
    </div>

    <div class="mb-3">
        <label for="especializacao" class="form-label">Especialização</label>
        <input value="<?= $professor['especializacao'] ?>" type="text" id="especializacao" name="especializacao" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <a href="professores.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
    require_once("rodape.php");
?>