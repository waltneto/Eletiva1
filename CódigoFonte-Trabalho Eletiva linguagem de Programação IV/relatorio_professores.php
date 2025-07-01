<?php
  session_start();
  // Redireciona para a página de login se o usuário não estiver autenticado
  if(!$_SESSION['acesso']){
    header("location: index.php?mensagem=acesso_negado");
  }

  /**
   * Retorna todos os professores cadastrados.
   *
   * @return array Um array associativo contendo os dados dos professores.
   */
  function retornarProfessoresRelatorio(){
    require("conexao.php"); // Inclui o arquivo de conexão com o banco de dados
    try{
        $sql = "SELECT id, nome, email, cpf, especializacao FROM professores ORDER BY nome ASC"; // Ordena por nome
        $stmt = $pdo->query($sql); // Executa a consulta SQL
        return $stmt->fetchAll(); // Retorna todos os resultados da consulta
    } catch (Exception $e){
        die("Erro ao consultar professores para relatório: " . $e->getMessage()); // Trata erros
    }
  }

  $professores_relatorio = retornarProfessoresRelatorio(); // Chama a função para obter os dados dos professores
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Professores</title>
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
                display: none !important; /* Esconde o botão de impressão no modo de impressão */
            }
            body {
                font-size: 12px;
                padding: 0;
            }
            .tabela th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact; /* Garante que a cor de fundo seja impressa */
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

    <div class="titulo">Relatório de Professores</div>
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
                <th>Especialização</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($professores_relatorio as $p): // Itera sobre os dados dos professores
            ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['nome'] ?></td>
                <td><?= $p['email'] ?></td>
                <td><?= $p['cpf'] ?></td>
                <td><?= $p['especializacao'] ?></td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

    <script>
        // Funções opcionais para melhor experiência de impressão, como visto em relatorio.php
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