<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exemplo de Calculadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"> </head>
  <body class="container">
    <h1 class="mt-5">Exemplo de Cálculos</h1>

    <p>Este é um exemplo de como processar dados enviados por um formulário PHP.</p>

    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="valor1" class="form-label">Valor 1:</label>
            <input type="number" step="any" name="valor1" id="valor1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="valor2" class="form-label">Valor 2:</label>
            <input type="number" step="any" name="valor2" id="valor2" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Calcular</button>
    </form>

    <h2>Resposta</h2>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $valor1 = (float)$_POST['valor1']; // Converter para float para cálculos decimais
                $valor2 = (float)$_POST['valor2']; // Converter para float para cálculos decimais

                echo "<p>O Valor 1 é: <b>$valor1</b></p>";
                echo "<p>O Valor 2 é: <b>$valor2</b></p>";

                $soma = $valor1 + $valor2;
                echo "<p>O valor da soma é: <b>$soma</b></p>";

                if ($valor2 != 0) { // Prevenir divisão por zero
                    $div = $valor1 / $valor2;
                    echo "<p>O valor da divisão é: <b>$div</b></p>";
                } else {
                    echo "<p class='text-danger'>Não é possível dividir por zero!</p>";
                }


                $mult = $valor1 * $valor2;
                echo "<p>O valor da multiplicação é: <b>$mult</b></p>";

                // Resto da divisão = %
                // Para float, se precisar de módulo, é necessário uma função como fmod
                if ($valor2 != 0) {
                     $resto_divisao = fmod($valor1, $valor2);
                     echo "<p>O resto da divisão (módulo) é: <b>$resto_divisao</b></p>";
                }

            } catch(Exception $e){
                echo "<p class='text-danger'>Erro ao realizar cálculos: " . $e->getMessage() . "</p>";
            }
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>