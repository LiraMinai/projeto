<div class="avatar">
    <canvas id="avatarHud" width="320" height="320"></canvas> 
</div> 

<script> window.dadosAvatar = 
    <?= json_encode( $avatar, 
        JSON_HEX_TAG |
        JSON_HEX_APOS | 
        JSON_HEX_QUOT | 
        JSON_HEX_AMP ) ?>;

        window.caminhoAvatar = "<?= $caminhoAvatar ?>";
</script> 

<script src="<?= $caminhoAvatar ?>pixelArt/exibirAvatar.js" defer></script>