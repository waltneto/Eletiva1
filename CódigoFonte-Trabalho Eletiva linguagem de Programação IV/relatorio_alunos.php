<?php
  session_start();
  if(!$_SESSION['acesso']){
    header("location: index.php?mensagem=acesso_negado");
  }

  function retornarAlunosRelatorio(){
    require("conexao.php");
    try{
        $sql = "SELECT id, nome, email, cpf, data_nascimento FROM alunos";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e){
        die("Erro ao consultar alunos para relatório: " . $e->getMessage());
    }
  }

  $alunos_relatorio = retornarAlunosRelatorio();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Alunos</title>
    <style>
        /* Estilo normal (tela) */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 20px;
        }
        .no-print {
            display: block;
        }
        .print-button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Estilo para impressão */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                font-size: 12px;
                padding: 0;
            }
            .tabela th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
            }
        }

        /* Seu CSS original */
        .titulo { text-align: center; font-size: 18px; font-weight: bold; }
        .tabela { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .tabela th, .tabela td { border: 1px solid #000; padding: 6px 10px; text-align: left; }
        .tabela th { background-color: #f0f0f0; }
    </style>
</head>
<body>

    <button class="print-button no-print" onclick="window.print()">Imprimir / Salvar como PDF</button>

    <div class="titulo">Relatório de Alunos</div>
    <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="col">Data: <?php echo date('d/m/Y H:i:s'); ?></div>
    </div>

    <table class="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($alunos_relatorio as $a):
            ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['nome'] ?></td>
                <td><?= $a['email'] ?></td>
                <td><?= $a['cpf'] ?></td>
                <td><?= date('d/m/Y', strtotime($a['data_nascimento'])) ?></td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

    <script>
        function beforePrint() {
            console.log("Preparando para impressão...");
        }
        function afterPrint() {
            console.log("Impressão concluída");
        }
        window.addEventListener('beforeprint', beforePrint);
        window.addEventListener('afterprint', afterPrint);
    </script>
</body>
</html>