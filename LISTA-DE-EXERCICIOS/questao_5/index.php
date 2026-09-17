<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício - Juros Compostos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 500px; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .campo { margin-bottom: 15px; }
        .campo label { display: block; font-weight: bold; margin-bottom: 5px; }
        .campo input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #218838; }
        .resultado { margin-top: 25px; padding: 15px; background: #e9ecef; border-left: 5px solid #28a745; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #28a745; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .total { font-weight: bold; color: #218838; font-size: 18px; margin-top: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Simulador de Juros Compostos</h2>

    <!-- Formulário HTML com os valores padrão solicitados no enunciado -->
    <form action="" method="POST">
        <div class="campo">
            <label for="capital">Investimento Inicial (R$):</label>
            <input type="number" id="capital" name="capital" step="0.01" value="1000.00" required>
        </div>
        <div class="campo">
            <label for="taxa">Taxa de Juros Mensal (%):</label>
            <input type="number" id="taxa" name="taxa" step="0.01" value="1.5" required>
        </div>
        <div class="campo">
            <label for="tempo">Período (Meses):</label>
            <input type="number" id="tempo" name="tempo" step="1" value="12" required>
        </div>
        <button type="submit" name="simular">Simular Rendimento</button>
    </form>

    <!-- Backend PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simular'])) {

        // Coleta e trata as entradas do formulário
        $saldo = floatval($_POST['capital']);
        $taxaPercentual = floatval($_POST['taxa']);
        $mesesTotais = intval($_POST['tempo']); // <--- CORRIGIDO AQUI (Sem o espaço)

        // Converte a taxa de porcentagem para valor decimal (ex: 1,5% vira 0.015)
        $taxaDecimal = $taxaPercentual / 100;

        echo "<div class='resultado'>";
        echo "<h3>Evolução do Investimento</h3>";
        echo "<table>";
        echo "<thead><tr><th>Mês</th><th>Rendimento do Mês</th><th>Saldo Acumulado</th></tr></thead>";
        echo "<tbody>";

        // Inicializa o contador do laço
        $mesAtual = 1;

        // Executa o laço de repetição WHILE mês a mês
        while ($mesAtual <= $mesesTotais) {

            // Calcula o rendimento exclusivo do mês corrente
            $rendimentoDoMes = $saldo * $taxaDecimal;

            // Atualiza o saldo somando o rendimento (Juros sobre Juros)
            $saldo += $rendimentoDoMes;

            // Formata os valores para a moeda Real (R$)
            $exibeRendimento = "R$ " . number_format($rendimentoDoMes, 2, ',', '.');
            $exibeSaldo = "R$ " . number_format($saldo, 2, ',', '.');

            // Imprime a linha da tabela
            echo "<tr>";
            echo "<td>Mês {$mesAtual}</td>";
            echo "<td>{$exibeRendimento}</td>";
            echo "<td>{$exibeSaldo}</td>";
            echo "</tr>";

            // Incrementa o contador do mês
            $mesAtual++;
        }

        echo "</tbody>";
        echo "</table>";

        // Exibe o saldo final destacado
        $saldoFinalFormatado = "R$ " . number_format($saldo, 2, ',', '.');
        echo "<div class='total'>Saldo Final Acumulado: {$saldoFinalFormatado}</div>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
