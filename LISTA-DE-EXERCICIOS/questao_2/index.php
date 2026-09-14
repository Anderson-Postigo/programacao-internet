<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificação de Triângulos</title>
</head>
<body>

    <h2>Classificação de Triângulos</h2>
    
    <!-- Formulário HTML com action vazio enviando via POST -->
    <form action="" method="POST">
        <label for="ladoA">Lado A:</label>
        <input type="number" step="0.1" name="lado_a" id="ladoA" required>
        <br><br>

        <label for="ladoB">Lado B:</label>
        <input type="number" step="0.1" name="lado_b" id="ladoB" required>
        <br><br>

        <label for="ladoC">Lado C:</label>
        <input type="number" step="0.1" name="lado_c" id="ladoC" required>
        <br><br>

        <button type="submit" name="verificar">Verificar Triângulo</button>
    </form>

    <br><hr><br>

    <?php
    if (isset($_POST['verificar'])) {
        // Coleta os três lados digitados
        $a = floatval($_POST['lado_a']);
        $b = floatval($_POST['lado_b']);
        $c = floatval($_POST['lado_c']);

        // 1. Condição para verificar se o triângulo é VÁLIDO
        // A soma de dois lados deve ser SEMPRE maior que o terceiro lado
        if (($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a)) {
            
            echo "<h3>Resultado:</h3>";
            echo "Os lados informados formam um triângulo válido!<br>";

            // 2. Estrutura condicional para CLASSIFICAR o triângulo
            if ($a == $b && $b == $c) {
                // Três lados iguais
                echo "<strong>Classificação: Equilátero</strong> (Três lados iguais).";
            } elseif ($a == $b || $a == $c || $b == $c) {
                // Apenas dois lados iguais
                echo "<strong>Classificação: Isósceles</strong> (Dois lados iguais).";
            } else {
                // Todos os lados diferentes
                echo "<strong>Classificação: Escaleno</strong> (Três lados diferentes).";
            }

        } else {
            // Se a soma de dois lados não for maior que o terceiro, não é um triângulo
            echo "<h3 style='color: red;'>Erro:</h3>";
            echo "Os lados informados <strong>NÃO</strong> formam um triângulo válido.";
        }
    }
    ?>

</body>
</html>
