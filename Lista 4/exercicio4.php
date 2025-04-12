<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Validar Data</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="dia" class="form-label">Dia:</label>
                <input type="number" class="form-control" id="dia" name="dia" required>
            </div>
            <div class="mb-3">
                <label for="mes" class="form-label">Mês:</label>
                <input type="number" class="form-control" id="mes" name="mes" required>
            </div>
            <div class="mb-3">
                <label for="ano" class="form-label">Ano:</label>
                <input type="number" class="form-control" id="ano" name="ano" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function validarData($dia, $mes, $ano) {
                if (checkdate($mes, $dia, $ano)) { // Função interna checkdate() para validar data
                    return sprintf("%02d/%02d/%04d", $dia, $mes, $ano); // Formatação da data
                } else {
                    return "Data inválida!";
                }
            }

            $dia = $_POST['dia'];
            $mes = $_POST['mes'];
            $ano = $_POST['ano'];
            echo "<p class='mt-3'>" . validarData($dia, $mes, $ano) . "</p>";
        }
        ?>
    </div>
</body>
</html>