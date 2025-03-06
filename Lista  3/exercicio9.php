<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];//O formulário recebe um número.

    $fatorial = 1;//Após o envio, inicializa-se a variável $fatorial como 1.
    if ($numero >= 1) $fatorial *= 1;//Para cada número de 1 a 10, verifica-se se o número informado é maior ou igual ao número atual.Se sim, multiplica-se o fatorial pelo número atual.
    if ($numero >= 2) $fatorial *= 2;
    if ($numero >= 3) $fatorial *= 3;
    if ($numero >= 4) $fatorial *= 4;
    if ($numero >= 5) $fatorial *= 5;
    if ($numero >= 6) $fatorial *= 6;
    if ($numero >= 7) $fatorial *= 7;
    if ($numero >= 8) $fatorial *= 8;
    if ($numero >= 9) $fatorial *= 9;
    if ($numero >= 10) $fatorial *= 10;

    echo "Fatorial: $fatorial";//Exibe-se o resultado do fatorial.
}
?>
<form method="POST">
    <input type="number" name="numero" required>
    <button type="submit">Enviar</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>