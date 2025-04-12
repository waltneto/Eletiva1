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
    <h1>Exercício 3</h1>
    <p>Informe os dados de 5 produtos, que são: código, nome e 
    preço.</p>

    <form action="exercicio3resposta.php" method="post">
    

    <?php for ($i = 1; $i <= 5; $i++) { ?>
            <h3>Produto <?= $i ?></h3>
            Código: <input type="text" name="codigo<?= $i ?>" required><br>
            Nome: <input type="text" name="nome<?= $i ?>" required><br>
            Preço: <input type="number" step="0.01" name="preco<?= $i ?>" required><br><br>
        <?php } ?>
            <button class="btn btn-primary">Adicionar produto</button>
        </form>

            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>