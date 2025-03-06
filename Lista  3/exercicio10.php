<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];//O formulário recebe um número.

    echo "$numero x 1 = " . ($numero * 1) . "<br>";//Após o envio, calcula-se e imprime-se a tabuada do número de 1 a 10 manualmente.
    echo "$numero x 2 = " . ($numero * 2) . "<br>";
    echo "$numero x 3 = " . ($numero * 3) . "<br>";
    echo "$numero x 4 = " . ($numero * 4) . "<br>";
    echo "$numero x 5 = " . ($numero * 5) . "<br>";
    echo "$numero x 6 = " . ($numero * 6) . "<br>";
    echo "$numero x 7 = " . ($numero * 7) . "<br>";
    echo "$numero x 8 = " . ($numero * 8) . "<br>";
    echo "$numero x 9 = " . ($numero * 9) . "<br>";
    echo "$numero x 10 = " . ($numero * 10) . "<br>";
}
?>
<form method="POST">
    <input type="number" name="numero" required>
    <button type="submit">Enviar</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>