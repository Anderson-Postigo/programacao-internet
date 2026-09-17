<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício - Estatística de Alturas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 600px; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .linha-grupo { display: flex; gap: 15px; margin-bottom: 10px; align-items: center; }
        .campo { flex: 1; }
        .campo label { display: block; font-weight: bold; margin-bottom: 3px; font-size: 14px; }
        .campo input { width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .num { font-weight: bold; color: #555; width: 30px; }
        button { background-color: #007bff; color: white; border: none; padding: 12px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; margin-top: 15px; }
        button:hover { background-color: #0056b3; }
        .resultado { margin-top: 25px; padding: 15px; background: #e9ecef; border-left: 5px solid #007bff; border-radius: 4px; }
        .resultado p { margin: 8px 0; font-size: 16px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Estatística de Alturas e Idades</h2>

    <form action="" method="POST">
        <!-- Usamos um laço FOR no HTML para gerar os 10 campos automaticamente -->
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <div class="linha-grupo">
                <span class="num">#<?= $i ?></span>
                <div class="campo">
                    <label for="idade_<?= $i ?>">Idade (anos):</label>
                    <input type="number" id="idade_<?= $i ?>" name="idades[]" min="0" max="120" required>
                </div>
                <div class="campo">
                    <label for="altura_<?= $i ?>">Altura (metros):</label>
                    <input type="number" id="altura_<?= $i ?>" name="alturas[]" step="0.01" min="0.50" max="2.50" required>
                </div>
            </div>
        <?php endfor; ?>

        <button type="submit" name="analisar">Analisar Dados</button>
    </form>

    <!-- Backend PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['analisar'])) {

        // O PHP recebe os dados do formulário como arrays (listas)
        $idades = $_POST['idades'];
        $alturas = $_POST['alturas'];

        // Inicializa variáveis de controle pegando o primeiro elemento do grupo
        $maiorAltura = floatval($alturas[0]);
        $menorAltura = floatval($alturas[0]);

        $somaAlturasMaiores18 = 0;
        $contadorMaiores18 = 0;

        // Percorre o conjunto de dados usando um laço FOR
        for ($k = 0; $k < 10; $k++) {
            $idadeAtual = intval($idades[$k]);
            $alturaAtual = floatval($alturas[$k]);

            // 1. Verifica se é a maior altura encontrada até agora
            if ($alturaAtual > $maiorAltura) {
                $maiorAltura = $alturaAtual;
            }

            // 2. Verifica se é a menor altura encontrada até agora
            if ($alturaAtual < $menorAltura) {
                $menorAltura = $alturaAtual;
            }

            // 3. Verifica se a pessoa tem mais de 18 anos para a estatística da média
            if ($idadeAtual > 18) {
                $somaAlturasMaiores18 += $alturaAtual;
                $contadorMaiores18++;
            }
        }

        // Calcula a média das pessoas com mais de 18 anos se houver alguma
        if ($contadorMaiores18 > 0) {
            $mediaFormatada = number_format(($somaAlturasMaiores18 / $contadorMaiores18), 2, ',', '.') . " m";
        } else {
            $mediaFormatada = "Nenhuma pessoa com mais de 18 anos informada.";
        }

        // Exibe as estatísticas finais na tela
        echo "<div class='resultado'>";
        echo "<h3>📊 Resultados da Análise</h3>";
        echo "<p><strong>Maior altura do grupo:</strong> " . number_format($maiorAltura, 2, ',', '.') . " m</p>";
        echo "<p><strong>Menor altura do grupo:</strong> " . number_format($menorAltura, 2, ',', '.') . " m</p>";
        echo "<p><strong>Média de altura dos maiores de 18 anos:</strong> {$mediaFormatada}</p>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
