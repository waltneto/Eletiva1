<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $n1 = $_POST['n1'];
    $n2 = $_POST['n2'];
    $n3 = $_POST['n3'];
    $n4 = $_POST['n4'];
    $n5 = $_POST['n5'];
    $n6 = $_POST['n6'];
    $n7 = $_POST['n7'];

    // Determinar o menor valor e sua posição
    $menor = $n1;
    $posicao = 1;

    if ($n2 < $menor) { $menor = $n2; $posicao = 2; }
    if ($n3 < $menor) { $menor = $n3; $posicao = 3; }
    if ($n4 < $menor) { $menor = $n4; $posicao = 4; }
    if ($n5 < $menor) { $menor = $n5; $posicao = 5; }
    if ($n6 < $menor) { $menor = $n6; $posicao = 6; }
    if ($n7 < $menor) { $menor = $n7; $posicao = 7; }

    echo "O menor valor é: $menor <br>";
    echo "Sua posição na sequência é: $posicao";
}
?>
<form method="POST">
    <input type="number" name="n1" required>
    <input type="number" name="n2" required>
    <input type="number" name="n3" required>
    <input type="number" name="n4" required>
    <input type="number" name="n5" required>
    <input type="number" name="n6" required>
    <input type="number" name="n7" required>
    <button type="number">Enviar</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>