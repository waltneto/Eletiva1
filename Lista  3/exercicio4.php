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
    $valor = $_POST['valor'];//O formulário recebe o valor de um produto.

    if ($valor > 100) {//Após o envio, verifica-se se o valor é maior que 100:
        $desconto = $valor * 0.15;
        $novoValor = $valor - $desconto;
        echo "Novo valor com desconto: R$" . numero_format($novoValor, 2, ',', '.');//Se sim, calcula-se o desconto de 15% e exibe-se o novo valor formatado.
    } else {
        echo "Valor sem desconto: R$" . number_format($valor, 2, ',', '.');//Caso contrário, exibe-se o valor original formatado.
    }
}
?>
<form method="POST">
    <input type="numero" step="0.01" name="valor" required>
    <button type="submit">Enviar</button>
</form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>