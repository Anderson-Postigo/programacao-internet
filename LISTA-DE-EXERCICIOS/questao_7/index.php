<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício - Média com Vetores</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 400px; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .campo { margin-bottom: 15px; }
        .campo label { display: block; font-weight: bold; margin-bottom: 5px; }
        .campo input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .resultado { margin-top: 25px; padding: 15px; border-radius: 5px; font-weight: bold; }
        .aprovado { background: #d4edda; color: #155724; border-left: 5px solid #28a745; }
        .recuperacao { background: #fff3cd; color: #856404; border-left: 5px solid #ffc107; }
        .reprovado { background: #f8d7da; color: #721c24; border-left: 5px solid #dc3545; }
    </style>
</head>
<body>

<div class="container">
    <h2>Cálculo de Média (Vetores)</h2>

    <!-- Formulário HTML enviando para o próprio arquivo -->
    <form action="" method="POST">
        <!-- Criando os 4 campos de notas que serão agrupados em um vetor no PHP -->
        <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="campo">
                <label for="nota_<?= $i ?>">Nota <?= $i ?>:</label>
                <input type="number" id="nota_<?= $i ?>" name="notas[]" step="0.1" min="0" max="10" required>
            </div>
        <?php endfor; ?>

        <button type="submit" name="calcular">Calcular Média</button>
    </form>

    <!-- Backend PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calcular'])) {

        // Recebe os dados do formulário diretamente em um vetor (Array Unidimensional)
        // Convertemos cada valor enviado para float usando array_map
        $notas = array_map('floatval', $_POST['notas']);

        // Utilizando funções nativas de array para o cálculo da média
        $totalElementos = count($notas); // Conta quantos elementos tem no vetor (serão 4)
        $somaNotas = array_sum($notas); // Soma todos os valores de dentro do vetor
        $media = $somaNotas / $totalElementos; // Calcula a média aritmética

        // Formata a média para exibição (ex: 7,5)
        $mediaFormatada = number_format($media, 1, ',', '.');

        // Estrutura condicional encadeada para definir a situação do aluno
        if ($media >= 7) {
            $classeCss = "aprovado";
            $situacao = "Aprovado";
        } elseif ($media >= 5 && $media < 7) {
            $classeCss = "recuperacao";
            $situacao = "Recuperação";
        } else {
            $classeCss = "reprovado";
            $situacao = "Reprovado";
        }

        // Exibição dos resultados na tela
        echo "<div class='resultado {$classeCss}'>";
        echo "<p>Média Final: {$mediaFormatada}</p>";
        echo "<p>Situação: {$situacao}</p>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
