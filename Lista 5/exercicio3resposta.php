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
    <h1>Exercício 3 Resposta</h1>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produtos = [];
    
    for ($i = 1; $i <= 5; $i++) {
        $codigo = $_POST["codigo$i"];
        $nome = $_POST["nome$i"];
        $preco = floatval($_POST["preco$i"]);
        
        if ($preco > 100) {
            $preco *= 0.9; // Aplicando desconto de 10%
        }
        
        $produtos[$codigo] = ["nome" => $nome, "preco" => $preco];
    }
    
    uasort($produtos, function($a, $b) {
        return strcmp($a["nome"], $b["nome"]);
    });
    
    echo "<h2>Lista de Produtos Ordenada por Nome</h2>";
    echo "<ul>";
    foreach ($produtos as $codigo => $dados) {
        echo "<li>Código: $codigo - Nome: {$dados['nome']} - Preço: R$" . number_format($dados['preco'], 2, ',', '.') . "</li>";
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