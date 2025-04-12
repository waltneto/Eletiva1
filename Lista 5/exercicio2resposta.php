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
    <h1>Exercício 2 Resposta</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $alunos = [];
    
    for ($i = 1; $i <= 5; $i++) {
        $nome = $_POST["nome$i"];
        $nota1 = floatval($_POST["nota1_$i"]);
        $nota2 = floatval($_POST["nota2_$i"]);
        $nota3 = floatval($_POST["nota3_$i"]);
        
        $media = ($nota1 + $nota2 + $nota3) / 3;
        $alunos[$nome] = $media;
    }
    
    arsort($alunos);
    
    echo "<h2>Lista de Alunos Ordenada por Média</h2>";
    echo "<ul>";
    foreach ($alunos as $nome => $media) {
        echo "<li>$nome - Média: " . number_format($media, 2) . "</li>";
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