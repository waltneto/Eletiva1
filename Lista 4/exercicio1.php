<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contagem de Caracteres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Contagem de Caracteres</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="palavra" class="form-label">Digite uma palavra:</label>
                <input type="text" class="form-control" id="palavra" name="palavra" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function contarCaracteres($palavra) {
                return strlen($palavra); // Função interna strlen() para contar caracteres
            }

            $palavra = $_POST['palavra'];
            echo "<p class='mt-3'>A palavra '$palavra' tem " . contarCaracteres($palavra) . " caracteres.</p>";
        }
        ?>
    </div>
</body>
</html>