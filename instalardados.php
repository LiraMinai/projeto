<?php

include("conexao.php");

echo "<h1>Instalação do Projeto</h1>";


// ======================================================
// ANOS ESCOLARES
// ======================================================

$sql = "INSERT IGNORE INTO anoEscolar
(idAnoEscolar, nomeAnoEscolar)
VALUES
(1, '1º Ano do Ensino Médio'),
(2, '2º Ano do Ensino Médio'),
(3, '3º Ano do Ensino Médio')";

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Anos escolares verificados.</p>";
} else {
    echo "<p>Erro nos anos escolares: " . mysqli_error($conexao) . "</p>";
}


// ======================================================
// MATÉRIAS
// ======================================================

$sql = "INSERT IGNORE INTO materia
(idMateria, idAnoEscolar, nomeMateria)
VALUES
(1, 1, 'Português'),
(2, 1, 'Inglês')";

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Matérias verificadas.</p>";
} else {
    echo "<p>Erro nas matérias: " . mysqli_error($conexao) . "</p>";
}


// ======================================================
// ARQUIVOS DE DADOS
// ======================================================

echo "<p>Carregando Português...</p>";

include("dados/dadosportugues.php");

echo "<p>✓ Português carregado.</p>";


echo "<p>Carregando Inglês...</p>";

include("dados/dadosingles.php");

echo "<p>✓ Inglês carregado.</p>";


// ======================================================
// FINAL
// ======================================================

echo "<hr>";

echo "<h2>🎉 Instalação concluída!</h2>";

echo "<p>Os conteúdos e questões foram cadastrados no banco.</p>";

?>
