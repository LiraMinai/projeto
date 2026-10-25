<?php
// levelup.php — popup "Parabéns, você subiu de nível!" com mini foto dos itens novos.
//
// Antes de incluir, defina:
//   $nivelNovo    (int)    nível que o personagem acabou de alcançar
//   $novosItens   (array)  item => nível, vindo de itensDesbloqueadosEntre()
//   $caminhoRaiz  (string) "" na raiz do projeto, "../" dentro de questao/ e materias/
?>
<style>
    .levelupFundo{
        position: fixed;
        inset: 0;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(20, 8, 38, 0.75);
    }
    .levelupCaixa{
        width: min(460px, 90vw);
        padding: 28px 24px;
        text-align: center;
        background: #3B1B5A;
        color: #FFF4D6;
        border: 3px solid #FFF4D6;
        border-radius: 16px;
        box-shadow: 0 8px 0 rgba(0, 0, 0, 0.3);
        animation: levelupEntra 0.35s ease-out;
    }
    @keyframes levelupEntra{
        from{ transform: scale(0.7); opacity: 0; }
        to{ transform: scale(1); opacity: 1; }
    }
    .levelupTitulo{
        margin: 0 0 8px;
        font-family: 'FonteYTUDS';
        font-size: 30px;
        color: #ffd98a;
    }
    .levelupTexto{
        margin: 6px 0;
        font-family: 'FonteTexto';
        font-size: 17px;
    }
    .levelupItens{
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin: 14px 0 6px;
        max-height: 250px;
        overflow-y: auto;
    }
    .levelupItem{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        width: 100px;
        padding: 8px 4px;
        background: #f5ecd2;
        color: #2b124c;
        border-radius: 10px;
        font-family: 'FonteTexto';
        font-size: 13px;
    }
    .miniItem{
        width: 80px;
        height: 80px;
        image-rendering: pixelated;
    }
    .levelupBotoes{
        display: flex;
        gap: 14px;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }
    .levelupBotoes .botaoEditarPersonagem{
        margin-left: 0;
    }
</style>

<div class="levelupFundo" id="levelupFundo">
    <div class="levelupCaixa">
        <h2 class="levelupTitulo">Parabéns!</h2>
        <p class="levelupTexto">Você subiu para o <strong>nível <?= (int) $nivelNovo ?></strong>!</p>

        <?php if (!empty($novosItens)): ?>
            <p class="levelupTexto">Novos itens desbloqueados:</p>
            <div class="levelupItens">
                <?php foreach ($novosItens as $item => $nivelItem): ?>
                    <div class="levelupItem">
                        <canvas class="miniItem" width="80" height="80"
                                data-src="<?= htmlspecialchars($caminhoRaiz . "pixelArt/" . $item . ".png") ?>"></canvas>
                        <span><?= htmlspecialchars(nomeItem($item)) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="levelupTexto">Já estão disponíveis na edição do personagem.</p>
        <?php endif; ?>

        <div class="levelupBotoes">
            <?php if (!empty($novosItens)): ?>
                <a class="botaoEditarPersonagem" href="<?= htmlspecialchars($caminhoRaiz) ?>editarpersonagem.php">Equipar agora</a>
            <?php endif; ?>
            <button type="button" onclick="document.getElementById('levelupFundo').remove()">Continuar</button>
        </div>
    </div>
</div>

<script>

const BASE = 512; 

document.querySelectorAll('.miniItem').forEach(canvas => {
    const img = new Image();
    img.onload = () => {

        const tmp = document.createElement('canvas');
        tmp.width = BASE;
        tmp.height = BASE;
        const tctx = tmp.getContext('2d');
        tctx.drawImage(img, 0, 0, BASE, BASE);

        const px = tctx.getImageData(0, 0, BASE, BASE).data;

        let x0 = BASE, y0 = BASE, x1 = -1, y1 = -1;
        for (let y = 0; y < BASE; y++) {
            for (let x = 0; x < BASE; x++) {
                if (px[(y * BASE + x) * 4 + 3] > 128) {
                    if (x < x0) x0 = x;
                    if (x > x1) x1 = x;
                    if (y < y0) y0 = y;
                    if (y > y1) y1 = y;
                }
            }
        }
        if (x1 < 0) return; 

        const w = x1 - x0 + 1;
        const h = y1 - y0 + 1;
        const escala = Math.min(canvas.width / w, canvas.height / h);
        const k = img.width / BASE; 
        const ctx = canvas.getContext('2d');
        ctx.imageSmoothingEnabled = escala < 1; 
        ctx.drawImage(img, x0 * k, y0 * k, w * k, h * k,
            (canvas.width - w * escala) / 2, (canvas.height - h * escala) / 2,
            w * escala, h * escala);
    };
    img.src = canvas.dataset.src;
});
</script>