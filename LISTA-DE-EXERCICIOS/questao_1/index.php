<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Desconto</title>
</head>
<body>

    <h2>Cálculo de Desconto em Compra</h2>
    
    <!-- Formulário HTML enviando dados para o próprio arquivo via POST -->
    <form action="" method="POST">
        <label for="valor">Valor Total da Compra (R$):</label>
        <input type="number" step="0.01" name="valor_total" id="valor" required>
        <br><br>

        <label for="tipo">Tipo de Cliente:</label>
        <select name="tipo_cliente" id="tipo" required>
            <option value="">Selecione...</option>
            <option value="1">1 - Cliente Comum (5%)</option>
            <option value="2">2 - VIP (10%)</option>
            <option value="3">3 - Funcionário (15%)</option>
        </select>
        <br><br>

        <button type="submit" name="calcular">Calcular Total</button>
    </form>

    <br><hr><br>

    <?php
    // Verifica se o formulário foi enviado clicando no botão "calcular"
    if (isset($_POST['calcular'])) {
        
        // Coleta e sanitiza os dados vindos do formulário
        $valor_total = floatval($_POST['valor_total']);
        $tipo_cliente = intval($_POST['tipo_cliente']);
        
        $porcentagem_desconto = 0;

        // Estrutura Condicional para definir a porcentagem do desconto
        switch ($tipo_cliente) {
            case 1:
                $porcentagem_desconto = 0.05; // 5%
                $nome_tipo = "Cliente Comum";
                break;
            case 2:
                $porcentagem_desconto = 0.10; // 10%
                $nome_tipo = "VIP";
                break;
            case 3:
                $porcentagem_desconto = 0.15; // 15%
                $nome_tipo = "Funcionário";
                break;
            default:
                $porcentagem_desconto = 0;
                $nome_tipo = "Não identificado";
                break;
        }

        // Cálculos matemáticos
        $valor_desconto = $valor_total * $porcentagem_desconto;
        $valor_final = $valor_total - $valor_desconto;

        // Exibição dos resultados formatados para o usuário
        echo "<h3>Resumo do Cálculo:</h3>";
        echo "Valor Original da Compra: R$ " . number_format($valor_total, 2, ',', '.') . "<br>";
        echo "Tipo de Cliente: " . $nome_tipo . "<br>";
        echo "Valor do Desconto: R$ " . number_format($valor_desconto, 2, ',', '.') . "<br>";
        echo "<strong>Valor Final a Pagar: R$ " . number_format($valor_final, 2, ',', '.') . "</strong>";
    }
    ?>

</body>
</html>
