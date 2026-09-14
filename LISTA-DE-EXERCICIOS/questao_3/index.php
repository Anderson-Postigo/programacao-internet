<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de IMC com Categoria</title>
</head>
<body>

    <h2>Cálculo de IMC com Categoria</h2>
    
    <!-- Formulário HTML com action vazio enviando via POST -->
    <form action="" method="POST">
        <label for="peso">Peso (kg):</label>
        <input type="number" step="0.1" name="peso" id="peso" required placeholder="Ex: 75.5">
        <br><br>

        <label for="altura">Altura (m):</label>
        <input type="number" step="0.01" name="altura" id="altura" required placeholder="Ex: 1.75">
        <br><br>

        <button type="submit" name="calcular">Calcular IMC</button>
    </form>

    <br><hr><br>

    <?php
    if (isset($_POST['calcular'])) {
        // Coleta os valores digitados de forma decimal
        $peso = floatval($_POST['peso']);
        $altura = floatval($_POST['altura']);

        // Evita a divisão por zero caso a altura inserida seja inválida
        if ($altura > 0) {
            
            // Fórmula do IMC: peso dividido pela altura ao quadrado
            $imc = $peso / ($altura * $altura);
            
            $classificacao = "";

            // Estrutura condicional para classificar a faixa de peso do IMC
            if ($imc < 18.5) {
                $classificacao = "Abaixo do peso";
            } elseif ($imc >= 18.5 && $imc < 25) {
                $classificacao = "Peso normal";
            } elseif ($imc >= 25 && $imc < 30) {
                $classificacao = "Sobrepeso";
            } else {
                $classificacao = "Obesidade";
            }

            // Exibição dos resultados formatados
            echo "<h3>Resultado do IMC:</h3>";
            echo "Seu IMC calculado é: <strong>" . number_format($imc, 2, ',', '.') . "</strong><br>";
            echo "Classificação: <strong>" . $classificacao . "</strong>";

        } else {
            echo "<h3 style='color: red;'>Erro:</h3>";
            echo "A altura informada precisa ser maior que zero.";
        }
    }
    ?>

</body>
</html>
