
<?php
// hud.php — barra inferior do personagem.
require_once __DIR__ . "/nivel.php";

$progresso = progressoNivel((int) $xp);

$vidaMaxima = $vidaMaxima ?? 50;
$ultimaRecarga = $ultimaRecarga ?? null;

// Calcula quantos segundos faltam para a próxima recuperação.
$tempoRestante = 0;

if ($vida < $vidaMaxima && !empty($ultimaRecarga)) {
    $agora = time();
    $ultima = strtotime($ultimaRecarga);
    $intervalo = 30 * 60;

    $proximoInstante = $ultima + $intervalo;
    $tempoRestante = max(0, $proximoInstante - $agora);
}
?>

<div class="hud">
    <?php include __DIR__ . "/avatar.php"; ?>

    <div class="info">
        <span class="textoPersonagem">
            <?= htmlspecialchars($nomePersonagem) ?>
        </span>

        <div class="status">
            <span class="textoPersonagem">
                ❤️ <?= (int) $vida ?>/<?= (int) $vidaMaxima ?>
            </span>

            <span
                class="textoPersonagem"
                id="contadorVida"
                data-segundos="<?= (int) $tempoRestante ?>"
            >
                <?php if ($vida < $vidaMaxima): ?>
                    ⏳ <span id="tempoVida">--:--</span>
                <?php endif; ?>
            </span>

            <span class="textoPersonagem">
                🔥 <?= (int) $sequencia ?>
            </span>
        </div>
    </div>

    <div class="nivelBox">
        <div class="nivelTopo textoPersonagem">
            <span>Nível <?= $progresso['nivel'] ?></span>
            <span>
                <?= $progresso['xpNoNivel'] ?> /
                <?= $progresso['xpNecessario'] ?> XP
            </span>
        </div>

        <div class="barraNivel">
            <div
                class="barraNivelPreenchida"
                style="width: <?= $progresso['porcentagem'] ?>%"
            ></div>
        </div>
    </div>

    <a
        class="botaoEditarPersonagem"
        href="<?= $caminhoAvatar ?>editarpersonagem.php"
    >
        ✏️ Editar personagem
    </a>
</div>

<script>
(() => {
    const contador = document.getElementById("contadorVida");
    const tempo = document.getElementById("tempoVida");

    if (!contador || !tempo) return;

    let segundos = Number(contador.dataset.segundos);

    function atualizarContador() {
        if (segundos <= 0) {
            tempo.textContent = "00:00";
            return;
        }

        const minutos = Math.floor(segundos / 60);
        const segundosRestantes = segundos % 60;

        tempo.textContent =
            String(minutos).padStart(2, "0") + ":" +
            String(segundosRestantes).padStart(2, "0");

        segundos--;
    }

    atualizarContador();
    setInterval(atualizarContador, 1000);
})();
</script>
