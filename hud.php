<?php
// hud.php — barra inferior: avatar, nome, vida, sequência, nível/XP e botão de editar.
//
// Antes de incluir, a página precisa ter definido:
//   $caminhoAvatar  ("" na raiz do projeto, "../" dentro de materias/ e questao/)
//   $avatar, $nomePersonagem, $vida, $sequencia, $xp
require_once __DIR__ . "/nivel.php";
$progresso = progressoNivel((int) $xp);
?>
<div class="hud">
    <?php include __DIR__ . "/avatar.php"; ?>

    <div class="info">
        <span class="textoPersonagem"><?= htmlspecialchars($nomePersonagem) ?></span>
        <div class="status">
            <span class="textoPersonagem">❤️ <?= $vida ?></span>
            <span class="textoPersonagem">🔥 <?= $sequencia ?></span>
        </div>
    </div>

    <div class="nivelBox">
        <div class="nivelTopo textoPersonagem">
            <span>Nível <?= $progresso['nivel'] ?></span>
            <span><?= $progresso['xpNoNivel'] ?> / <?= $progresso['xpNecessario'] ?> XP</span>
        </div>
        <div class="barraNivel">
            <div class="barraNivelPreenchida" style="width: <?= $progresso['porcentagem'] ?>%"></div>
        </div>
    </div>

    <a class="botaoEditarPersonagem" href="<?= $caminhoAvatar ?>editarpersonagem.php">✏️ Editar personagem</a>
</div>