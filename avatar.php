<div class="avatar">
    <canvas id="avatarHud" width="300" height="300"></canvas> 
</div> 

<script> window.dadosAvatar = 
    <?= json_encode( $avatar, 
        JSON_HEX_TAG |
        JSON_HEX_APOS | 
        JSON_HEX_QUOT | 
        JSON_HEX_AMP ) ?>;
</script> 

<script src="pixelArt/exibirAvatar.js" defer></script>