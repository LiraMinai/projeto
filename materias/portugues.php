<?php
session_start();
include("../conexao.php");

if (!isset($_SESSION["idUsuario"])) {
    header("Location: ../entrar.php");
    exit;
}

$idMateria = 1;

$stmt = $conexao->prepare("SELECT idConteudo, nomeConteudo FROM conteudo WHERE idMateria = ? ORDER BY idConteudo");
$stmt->bind_param("i", $idMateria);
$stmt->execute();
$conteudos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>Português</title>
</head>
<body>
    <header>
        <div class= "logo">
            <img src="../imagens/logo.png" alt="Logo">
            <h1 class="tituloCad">YDUTS</h1>
        </div>
        <h1 class="tituloCad2">PORTUGUÊS</h1>
    </header>
    <div class="materias">
        <?php foreach ($conteudos as $c): ?>
            <button onclick="window.location.href='../questao/questao.php?conteudo=<?= $c['idConteudo'] ?>'">
                <?= htmlspecialchars($c['nomeConteudo']) ?>
            </button>
        <?php endforeach; ?>

        <?php if (empty($conteudos)): ?>
            <p class="texto">Nenhum conteúdo cadastrado ainda. Rode o instalardados.php.</p>
        <?php endif; ?>
    </div>
</body>
</html>