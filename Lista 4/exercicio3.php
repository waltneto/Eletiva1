<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Substring</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Verificar Substring</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="palavra1" class="form-label">Primeira palavra:</label>
                <input type="text" class="form-control" id="palavra1" name="palavra1" required>
            </div>
            <div class="mb-3">
                <label for="palavra2" class="form-label">Segunda palavra:</label>
                <input type="text" class="form-control" id="palavra2" name="palavra2" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function verificarContido($palavra1, $palavra2) {
                return strpos($palavra1, $palavra2) !== false; // Função interna strpos() para verificar substring
            }

            $palavra1 = $_POST['palavra1'];
            $palavra2 = $_POST['palavra2'];
            if (verificarContido($palavra1, $palavra2)) {
                echo "<p class='mt-3'>'$palavra2' está contida em '$palavra1'.</p>";
            } else {
                echo "<p class='mt-3'>'$palavra2' não está contida em '$palavra1'.</p>";
            }
        }
        ?>
    </div>
</body>
</html>