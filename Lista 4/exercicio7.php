<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diferença de Dias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Diferença de Dias</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="data1" class="form-label">Primeira data (AAAA-MM-DD):</label>
                <input type="date" class="form-control" id="data1" name="data1" required>
            </div>
            <div class="mb-3">
                <label for="data2" class="form-label">Segunda data (AAAA-MM-DD):</label>
                <input type="date" class="form-control" id="data2" name="data2" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function diferencaDias($data1, $data2) {
                $timestamp1 = strtotime($data1); // Função interna strtotime() para converter data em timestamp
                $timestamp2 = strtotime($data2);
                if ($timestamp1 && $timestamp2) {
                    $diferenca = abs(($timestamp2 - $timestamp1) / (60 * 60 * 24)); // Cálculo da diferença em dias
                    return $diferenca;
                } else {
                    return "Data inválida!";
                }
            }

            $data1 = $_POST['data1'];
            $data2 = $_POST['data2'];
            echo "<p class='mt-3'>A diferença de dias entre $data1 e $data2 é " . diferencaDias($data1, $data2) . " dias.</p>";
        }
        ?>
    </div>
</body>
</html>