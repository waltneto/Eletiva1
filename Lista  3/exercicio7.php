<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];

    $soma = 0;
    if ($numero >= 1) $soma += 1;
    if ($numero >= 2) $soma += 2;
    if ($numero >= 3) $soma += 3;
    if ($numero >= 4) $soma += 4;
    if ($numero >= 5) $soma += 5;
    if ($numero >= 6) $soma += 6;
    if ($numero >= 7) $soma += 7;
    if ($numero >= 8) $soma += 8;
    if ($numero >= 9) $soma += 9;
    if ($numero >= 10) $soma += 10;

    echo "Soma: $soma";
}
?>
<form method="POST">
    <input type="number" name="numero" required>
    <button type="submit">Enviar</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>