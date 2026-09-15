<?php
session_start();
include("conexao.php");

$id = $_SESSION['idUsuario'];

$sql = "
        SELECT
            u.sequenciaCheckinUsuario,
            u.ultimoCheckinUsuario,
            p.idPersonagem,
            p.nomePersonagem,
            p.vidaAtualPersonagem,
            p.vidaMaximaPersonagem,
            p.ultimaRecargaVidaPersonagem,
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
include "vida.php";
$vida = recarregarVida(
    $conexao,
    $dados["idPersonagem"],
    $vida,
    $dados["vidaMaximaPersonagem"],
    $dados["ultimaRecargaVidaPersonagem"]
);

$sequencia       = $dados["sequenciaCheckinUsuario"];
$hoje = new DateTime();
$ultimoCheckin = $dados['ultimoCheckinUsuario'] ? new DateTime($dados['ultimoCheckinUsuario']) : null;

if ($ultimoCheckin === null || $ultimoCheckin->format('Y-m-d') !== $hoje->format('Y-m-d')) {
    if ($ultimoCheckin !== null) {
        $ontem = (clone $hoje)->modify('-1 day');
        $sequencia = ($ultimoCheckin->format('Y-m-d') === $ontem->format('Y-m-d'))
            ? $sequencia + 1  // check-in em dias seguidos, mantém a sequência
            : 1;              // pulou um dia, quebrou a sequência
    } else {
        $sequencia = 1; // primeiro check-in de todos
    }

    $hojeStr = $hoje->format('Y-m-d');
    $stmt = $conexao->prepare("UPDATE usuario SET sequenciaCheckinUsuario = ?, ultimoCheckinUsuario = ?, melhorSequenciaUsuario = GREATEST(melhorSequenciaUsuario, ?) WHERE idUsuario = ?");
    $stmt->bind_param("isii", $sequencia, $hojeStr, $sequencia, $id);
    $stmt->execute();
}

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
            <span class="textoPersonagem"><?= $nomePersonagem ?></span>
            <div class="status">
                <span class="textoPersonagem">❤️ <?= $vida ?></span>
                <span class="textoPersonagem">🔥 <?= $sequencia ?></span>
            </div>
        </div>
    </div>
</body>
</html>