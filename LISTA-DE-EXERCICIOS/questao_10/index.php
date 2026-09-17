<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício - Diagonal Principal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 500px; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .campo-grupo { display: flex; gap: 15px; margin-bottom: 15px; }
        .campo { flex: 1; }
        .campo label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        .campo input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #6f42c1; color: white; border: none; padding: 12px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #59359a; }
        .resultado { margin-top: 25px; padding: 15px; background: #e9ecef; border-left: 5px solid #6f42c1; border-radius: 4px; }

        /* Estilização da tabela para parecer uma matriz matemática */
        .matriz-table { border-collapse: collapse; margin: 20px auto; }
        .matriz-table td { border: 2px solid #333; width: 50px; height: 50px; text-align: center; font-size: 18px; font-weight: bold; font-family: monospace; }
        .diagonal-destaque { background-color: #e2d9f3; color: #6f42c1; border: 3px solid #6f42c1 !important; }
        .soma-texto { font-size: 18px; font-weight: bold; color: #6f42c1; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Matriz Aleatória e Diagonal Principal (3×3)</h2>

    <!-- Formulário para definir o intervalo dos números aleatórios -->
    <form action="" method="POST">
        <div class="campo-grupo">
            <div class="campo">
                <label for="min">Valor Mínimo:</label>
                <input type="number" id="min" name="min" value="1" required>
            </div>
            <div class="campo">
                <label for="max">Valor Máximo:</label>
                <input type="number" id="max" name="max" value="50" required>
            </div>
        </div>
        <button type="submit" name="gerar">Gerar Matriz e Somar</button>
    </form>

    <!-- Backend PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gerar'])) {

        $min = intval($_POST['min']);
        $max = intval($_POST['max']);

        // Garante que o mínimo não seja maior que o máximo
        if ($min > $max) {
            $temp = $min;
            $min = $max;
            $max = $temp;
        }

        $matriz = [];
        $somaDiagonal = 0;

        // 1. Estrutura de laços aninhados para construir a matriz 3x3 com números aleatórios
        for ($l = 0; $l < 3; $l++) {
            for ($c = 0; $c < 3; $c++) {
                // rand() gera um número inteiro aleatório entre o mínimo e o máximo estipulados
                $matriz[$l][$c] = rand($min, $max);
            }
        }

        echo "<div class='resultado'>";
        echo "<h3>🎲 Matriz Gerada:</h3>";
        echo "<table class='matriz-table'>";

        // 2. Estrutura para exibir a matriz e efetuar a soma da diagonal principal
        for ($l = 0; $l < 3; $l++) {
            echo "<tr>";
            for ($c = 0; $c < 3; $c++) {
                $valorAtual = $matriz[$l][$c];
                $classeCss = "";

                // REGRA DE OURO: Se o índice da linha for igual ao da coluna, faz parte da diagonal principal
                if ($l == $c) {
                    $somaDiagonal += $valorAtual;
                    $classeCss = "class='diagonal-destaque'"; // Destaca visualmente a célula
                }

                echo "<td {$classeCss}>{$valorAtual}</td>";
            }
            echo "</tr>";
        }

        echo "</table>";

        // Exibe a rotina de soma detalhada na tela
        echo "<div class='soma-texto'>";
        echo "Soma da Diagonal Principal (";
        echo $matriz[0][0] . " + " . $matriz[1][1] . " + " . $matriz[2][2];
        echo ") = {$somaDiagonal}";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
