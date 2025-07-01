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
    <h1>Exercício 5 Resposta</h1>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livros = [];
    
    for ($i = 1; $i <= 5; $i++) {
        $titulo = $_POST["titulo$i"];
        $quantidade = intval($_POST["quantidade$i"]);
        
        $livros[$titulo] = $quantidade;
    }
    
    ksort($livros);
    
    echo "<h2>Lista de Livros Ordenada por Título</h2>";
    echo "<ul>";
    foreach ($livros as $titulo => $quantidade) {
        echo "<li>Título: $titulo - Quantidade em Estoque: $quantidade";
        if ($quantidade < 5) {
            echo " <strong>(Baixo Estoque)</strong>";
        }
        echo "</li>";
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