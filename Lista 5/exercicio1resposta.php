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
    <h1>Exercício 1 Resposta</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $contato = array();
            $nomes = $_POST['nome'];
            $telefones = $_POST['telefone'];

            // loop para ler os valores recebidos.
            // count é uma função que conta o número de elementos (é como se fosse a função len)
            for ($i = 0; $i < count($nomes); $i++) {
                $nome = $nomes[$i];
                $telefone = $telefones[$i];

                // array_key_exists é uma função pronta do php que verifica se o nome já existe.
                if (array_key_exists($nome, $contato)) {
                    echo "<p>Nome '$nome' já foi registrado.</p>";
                }

                // Verifica se o telefone já existe.
                elseif (in_array($telefone, $contato)) {
                    echo "<p>Número de telefone '$telefone' já foi registrado.</p>";
                }

                // Se não tiver duplicatas, adiciona o contato ao array.
                else {
                    $contato[$nome] = $telefone;
                }
            }
            // ksort ordena os contatos pelos nomes (chave).
            ksort($contato);
            // Exibi os resultados.
            foreach ($contato as $nome => $telefone) {
                echo "<p>Nome: {$nome} ------ Telefone: {$telefone}</p>";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>