<?php
session_start();
include("../conexao.php");

if (!isset($_SESSION["idUsuario"])) {
    header("Location: ../entrar.php");
    exit;
}

$sql = "
        SELECT
            u.sequenciaCheckinUsuario,
            p.nomePersonagem,
            p.vidaAtualPersonagem,
            p.nivelPersonagem,
            p.xpPersonagem,
            p.avatarPersonagem
        FROM usuario u
        INNER JOIN personagem p
        ON u.idUsuario = p.idUsuario
        WHERE u.idUsuario = ?
        ";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$dados = $stmt->get_result()->fetch_assoc();

$nomePersonagem = $dados["nomePersonagem"];
$vida            = $dados["vidaAtualPersonagem"];
$sequencia       = $dados["sequenciaCheckinUsuario"];
$nivel           = $dados["nivelPersonagem"];
$xp              = $dados["xpPersonagem"];
$avatar          = json_decode($dados["avatarPersonagem"], true) ?? [];

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
        <div class="hud">
        <?php
        $caminhoAvatar = "";
        include "../avatar.php";
        ?>
        <div class="info">
            <span class="nome"><?= $nomePersonagem ?></span>
            <div class="status">
                <span>❤️ <?= $vida ?></span>
                <span>🔥 <?= $sequencia ?></span>
            </div>
        </div>
    </div>
    </div>
</body>
</html>