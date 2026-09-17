<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício - Matriz de Notas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 650px; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .linha-aluno { background: #f1f3f5; padding: 15px; border-radius: 6px; margin-bottom: 15px; border-left: 5px solid #007bff; }
        .linha-aluno h4 { margin: 0 0 10px 0; color: #007bff; }
        .campos-grupo { display: flex; gap: 15px; }
        .campo { flex: 1; }
        .campo label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        .campo input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; padding: 12px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; margin-top: 10px; }
        button:hover { background-color: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .media-destaque { font-weight: bold; color: #28a745; }
    </style>
</head>
<body>

<div class="container">
    <h2>Tabela de Notas da Turma (Matriz 3×3)</h2>

    <!-- Formulário HTML para capturar os dados dos 3 alunos -->
    <form action="" method="POST">
        <?php for ($i = 0; $i < 3; $i++): ?>
            <div class="linha-aluno">
                <h4>Aluno #<?= $i + 1 ?></h4>
                <div class="campos-grupo">
                    <div class="campo">
                        <label for="nome_<?= $i ?>">Nome:</label>
                        <input type="text" id="nome_<?= $i ?>" name="turma[<?= $i ?>][0]" required placeholder="Nome do Aluno">
                    </div>
                    <div class="campo">
                        <label for="n1_<?= $i ?>">Nota 1:</label>
                        <input type="number" id="n1_<?= $i ?>" name="turma[<?= $i ?>][1]" step="0.1" min="0" max="10" required placeholder="0.0">
                    </div>
                    <div class="campo">
                        <label for="n2_<?= $i ?>">Nota 2:</label>
                        <input type="number" id="n2_<?= $i ?>" name="turma[<?= $i ?>][2]" step="0.1" min="0" max="10" required placeholder="0.0">
                    </div>
                </div>
            </div>
        <?php endfor; ?>

        <button type="submit" name="processar">Gerar Boletim</button>
    </form>

    <!-- Backend PHP -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['processar'])) {

        // Recebe a matriz diretamente do formulário HTML
        $matrizTurma = $_POST['turma'];

        echo "<table>";
        echo "<thead><tr><th>Nome do Aluno</th><th>Nota 1</th><th>Nota 2</th><th>Média Final</th></tr></thead>";
        echo "<tbody>";

        // Laço Externo: Percorre cada uma das 3 LINHAS (cada linha é um aluno)
        for ($linha = 0; $linha < 3; $linha++) {
            echo "<tr>";

            $somaNotas = 0;
            $nomeAluno = "";

            // Laço Interno Aninhado: Percorre as 3 COLUNAS da linha atual
            // Coluna 0 = Nome | Coluna 1 = Nota 1 | Coluna 2 = Nota 2
            for ($coluna = 0; $coluna < 3; $coluna++) {
                $dadoAtual = $matrizTurma[$linha][$coluna];

                if ($coluna == 0) {
                    // Guarda o nome e exibe na primeira célula da tabela
                    $nomeAluno = htmlspecialchars($dadoAtual);
                    echo "<td>{$nomeAluno}</td>";
                } else {
                    // Se for coluna 1 ou 2, acumula o valor para calcular a média e exibe a nota
                    $nota = floatval($dadoAtual);
                    $somaNotas += $nota;
                    echo "<td>" . number_format($nota, 1, ',', '.') . "</td>";
                }
            }

            // Fora do laço interno (mas ainda dentro da linha do aluno), calcula a média das 2 notas
            $mediaIndividual = $somaNotas / 2;

            // Exibe a média na última coluna da linha corrente
            echo "<td class='media-destaque'>" . number_format($mediaIndividual, 1, ',', '.') . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    }
    ?>
</div>

</body>
</html>
