<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 1 Resposta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>Exercício 4 Resposta</h1>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itens = [];
    
    for ($i = 1; $i <= 5; $i++) {
        $nome = $_POST["nome$i"];
        $preco = floatval($_POST["preco$i"]);
        
        // Aplicando imposto de 15%
        $preco_com_imposto = $preco * 1.15;
        
        $itens[$nome] = $preco_com_imposto;
    }
    
    asort($itens);
    
    echo "<h2>Lista de Itens Ordenada por Preço (com Imposto)</h2>";
    echo "<ul>";
    foreach ($itens as $nome => $preco) {
        echo "<li>Nome: $nome - Preço com Imposto: R$" . number_format($preco, 2, ',', '.') . "</li>";
    }
    echo "</ul>";
} else {
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>