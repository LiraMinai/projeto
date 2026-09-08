<?php
session_start();
include("conexao.php");

$id = $_SESSION['idUsuario'];

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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>YDUTS</title>
</head>
<body>
    <header>
        <div class= "logo">
            <img src="imagens/logo.png" alt="Logo">
            <h1 class="tituloCad">YDUTS</h1>
        </div>
        <h1 class="tituloCad2">MATÉRIAS</h1>
    </header>
<div class="materias">
    <button onclick="window.location.href='materias/portugues.php'">Português</button>
    <button onclick="window.location.href='materias/ingles.php'">Inglês</button>
</div>
    <div class="hud">
        <?php
        $caminhoAvatar = "";
        include "avatar.php";
        ?>
        <div class="info">
            <span class="nome"><?= $nomePersonagem ?></span>
            <div class="status">
                <span>❤️ <?= $vida ?></span>
                <span>🔥 <?= $sequencia ?></span>
            </div>
        </div>
    </div>
</body>
</html>