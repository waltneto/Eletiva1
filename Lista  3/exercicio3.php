<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //O formulário recebe dois números (A e B).
    $a = $_POST['a'];
    $b = $_POST['b'];

    if ($a == $b) {
        echo "Números iguais: $a"; //Após o envio, verifica-se se os números são iguais: Se forem diferentes, compara-se os valores:
            
            
            
            
    } else {
        if ($a < $b) {//Se A < B, mostra  na ordem A B.
            echo "$a $b";
        } else {
            echo "$b $a";//Caso contrário, imprime-se na ordem B A.
        }
    }
}
?>
<form method="POST">
    <input type="number" name="a" required>
    <input type="number" name="b" required>
    <button type="submit">Enviar</button>
</form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>