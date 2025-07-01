<?php
  session_start();
  // Redireciona para a página de login se o usuário não estiver autenticado
  if(!$_SESSION['acesso']){
    header("location: index.php?mensagem=acesso_negado");
  }

  /**
   * Retorna todas as matrículas com os nomes completos de aluno, curso e professor.
   *
   * @return array Um array associativo contendo os dados das matrículas.
   */
  function retornarMatriculasRelatorio(){
    require("conexao.php"); // Inclui o arquivo de conexão com o banco de dados
    try{
        $sql = "SELECT m.id, a.nome as nome_aluno, c.nome as nome_curso, p.nome as nome_professor, m.data_matricula
                FROM matriculas m
                INNER JOIN alunos a ON a.id = m.aluno_id
                INNER JOIN cursos c ON c.id = m.curso_id
                INNER JOIN professores p ON p.id = m.professor_id
                ORDER BY m.data_matricula DESC"; // Ordena pelas matrículas mais recentes
        $stmt = $pdo->query($sql); // Executa a consulta SQL
        return $stmt->fetchAll(); // Retorna todos os resultados da consulta
    } catch (Exception $e){
        die("Erro ao consultar matrículas para relatório: " . $e->getMessage()); // Trata erros
    }
  }

  $matriculas_relatorio = retornarMatriculasRelatorio(); // Chama a função para obter os dados das matrículas
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Matrículas</title>
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

    <div class="titulo">Relatório de Matrículas</div>
    <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="col">Data: <?php echo date('d/m/Y H:i:s'); ?></div>
    </div>

    <table class="tabela">
        <thead>
            <tr>
                <th>ID Matrícula</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Professor</th>
                <th>Data da Matrícula</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($matriculas_relatorio as $m): // Itera sobre os dados das matrículas
            ?>
            <tr>
                <td><?= $m['id'] ?></td>
                <td><?= $m['nome_aluno'] ?></td>
                <td><?= $m['nome_curso'] ?></td>
                <td><?= $m['nome_professor'] ?></td>
                <td><?= date('d/m/Y H:i:s', strtotime($m['data_matricula'])) ?></td>
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