<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maiúsculo e Minúsculo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Maiúsculo e Minúsculo</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="palavra" class="form-label">Digite uma palavra:</label>
                <input type="text" class="form-control" id="palavra" name="palavra" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function formatarPalavra($palavra) {
                $maiusculo = strtoupper($palavra); // Função interna strtoupper() para maiúsculas
                $minusculo = strtolower($palavra); // Função interna strtolower() para minúsculas
                return [$maiusculo, $minusculo];
            }

            $palavra = $_POST['palavra'];
            list($maiusculo, $minusculo) = formatarPalavra($palavra);
            echo "<p class='mt-3'>Maiúsculo: $maiusculo</p>";
            echo "<p>Minúsculo: $minusculo</p>";
        }
        ?>
    </div>
</body>
</html>