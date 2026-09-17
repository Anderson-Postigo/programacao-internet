<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício - Tabuada com For</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 400px; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .campo { margin-bottom: 15px; }
        .campo label { display: block; font-weight: bold; margin-bottom: 5px; }
        .campo input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .resultado { margin-top: 25px; padding: 15px; background: #e9ecef; border-left: 5px solid #007bff; border-radius: 4px; }
        .linha-tabuada { font-family: 'Courier New', Courier, monospace; font-size: 16px; margin: 5px 0; }
    </style>
</head>
<body>

<div class="container">
    <h2>Gerador de Tabuada</h2>

    <!-- Formulário HTML (Action vazio envia para o próprio arquivo) -->
    <form action="" method="POST">
        <div class="campo">
            <label for="numero">Digite um número inteiro:</label>
            <input type="number" id="numero" name="numero" step="1" required>
        </div>
        <button type="submit" name="calcular">Gerar Tabuada</button>
    </form>

    <!-- Backend PHP -->
    <?php
    // Verifica se o formulário foi enviado via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calcular'])) {

        // Recebe o valor do formulário e garante que seja tratado como um número inteiro
        $numero = intval($_POST['numero']);

        echo "<div class='resultado'>";
        echo "<h3>Tabuada do número: {$numero}</h3>";

        // Estrutura de repetição FOR do 1 ao 10
        for ($i = 1; $i <= 10; $i++) {
            // Calcula o produto corrente
            $resultado = $numero * $i;

            // Exibe a linha no formato claro solicitado (ex: 5 x 1 = 5)
            echo "<div class='linha-tabuada'>{$numero} x {$i} = {$resultado}</div>";
        }

        echo "</div>";
    }
    ?>
</div>

</body>
</html>
