<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício - Faturamento Semanal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 500px; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .campo { margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; }
        .campo label { font-weight: bold; width: 150px; font-size: 14px; }
        .campo input { width: 60%; padding: 6px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; margin-top: 15px; }
        button:hover { background-color: #218838; }
        .resultado { margin-top: 25px; padding: 15px; background: #e9ecef; border-left: 5px solid #28a745; border-radius: 4px; }
        .resultado p { margin: 8px 0; font-size: 16px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Análise de Faturamento Semanal</h2>

    <!-- Formulário HTML com os 7 dias da semana -->
    <form action="" method="POST">
        <?php
        $diasDaSemana = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"];
        foreach ($diasDaSemana as $dia):
        ?>
            <div class="campo">
                <label for="<?= $dia ?>"><?= $dia ?>:</label>
                <!-- Usamos o nome do dia como chave dentro do array 'vendas' -->
                <input type="number" id="<?= $dia ?>" name="vendas[<?= $dia ?>]" step="0.01" min="0" placeholder="R$ 0,00" required>
            </div>
        <?php endforeach; ?>

        <button type="submit" name="analisar">Analisar Faturamento</button>
    </form>

    <!-- Backend PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['analisar'])) {

        // Coleta o vetor associativo e garante valores numéricos reais (float)
        $vendas = array_map('floatval', $_POST['vendas']);

        // 1. Calcula o valor total vendido na semana
        $totalVendido = array_sum($vendas);

        // Calcula a média semanal de vendas (dividido por 7 dias)
        $mediaSemanal = $totalVendido / count($vendas);

        // 2. Identifica o dia com o maior faturamento
        $maiorValor = max($vendas); // Acha o maior número do vetor
        $diaMaiorFaturamento = array_search($maiorValor, $vendas); // Busca a chave (dia) que possui esse maior número

        // 3. Conta quantos dias ficaram acima da média semanal
        $diasAcimaDaMedia = 0;

        // Usamos o foreach para varrer o vetor associativo pegando a Chave ($dia) e o Valor ($valor)
        foreach ($vendas as $dia => $valor) {
            if ($valor > $mediaSemanal) {
                $diasAcimaDaMedia++;
            }
        }

        // Exibição dos resultados na tela
        echo "<div class='resultado'>";
        echo "<h3>📊 Relatório de Desempenho</h3>";
        echo "<p><strong>Faturamento Total:</strong> R$ " . number_format($totalVendido, 2, ',', '.') . "</p>";
        echo "<p><strong>Média Diária:</strong> R$ " . number_format($mediaSemanal, 2, ',', '.') . "</p>";
        echo "<p><strong>Melhor Dia:</strong> {$diaMaiorFaturamento} (R$ " . number_format($maiorValor, 2, ',', '.') . ")</p>";
        echo "<p><strong>Dias acima da média:</strong> {$diasAcimaDaMedia} dia(s)</p>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
