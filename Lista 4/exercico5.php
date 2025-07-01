<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raiz Quadrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Calcular Raiz Quadrada</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="numero" class="form-label">Digite um número:</label>
                <input type="number" class="form-control" id="numero" name="numero" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function calcularRaizQuadrada($numero) {
                if ($numero >= 0) {
                    return sqrt($numero); // Função interna sqrt() para raiz quadrada
                } else {
                    return "Número inválido (não pode ser negativo).";
                }
            }

            $numero = $_POST['numero'];
            echo "<p class='mt-3'>A raiz quadrada de $numero é " . calcularRaizQuadrada($numero) . ".</p>";
        }
        ?>
    </div>
</body>
</html>