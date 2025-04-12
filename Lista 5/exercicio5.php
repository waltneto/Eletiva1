<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>Exercício 5</h1>
    <p>Informe os dados de 5 livros: título e quantidade em 
    estoque.</p>

    <form action="exercicio5resposta.php" method="post">
    <?php for ($i = 1; $i <= 5; $i++) { ?>
            <h3>Livro <?= $i ?></h3>
            Título: <input type="text" name="titulo<?= $i ?>" required><br>
            Quantidade em Estoque: <input type="number" name="quantidade<?= $i ?>" required><br><br>
        <?php } ?>
        <button type="submit">Adicionar Item</button>
    </form>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>