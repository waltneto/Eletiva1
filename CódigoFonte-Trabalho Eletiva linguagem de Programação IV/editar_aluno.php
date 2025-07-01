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

    function alterarAluno($nome, $email, $cpf, $data_nascimento, $id){
        require("conexao.php");
        try{
            $sql = "UPDATE alunos SET nome = ?, email = ?, cpf = ?, data_nascimento = ? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $email, $cpf, $data_nascimento, $id])){
                header('location: alunos.php?edicao=true');
            } else {
                header('location: alunos.php?edicao=false');
            }
        } catch (Exception $e){
            die("Erro ao alterar o aluno: ".$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $data_nascimento = $_POST['data_nascimento'];
        $id = $_POST['id'];
        alterarAluno($nome, $email, $cpf, $data_nascimento, $id);
    } else {
        $aluno = consultaAluno($_GET['id']);
    }
?>

<h2>Alterar Aluno</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $aluno['id'] ?>" >

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input value="<?= $aluno['nome'] ?>" type="text" id="nome" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input value="<?= $aluno['email'] ?>" type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF (Ex: 123.456.789-00)</label>
        <input value="<?= $aluno['cpf'] ?>" type="text" id="cpf" name="cpf" class="form-control" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 123.456.789-00">
    </div>

    <div class="mb-3">
        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
        <input value="<?= $aluno['data_nascimento'] ?>" type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <a href="alunos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
    require_once("rodape.php");
?>