<div class="avatar">
    <canvas id="avatarHud" width="300" height="300"></canvas> 
</div> 

<script> window.dadosAvatar = 
    <?= json_encode( $avatar, 
        JSON_HEX_TAG |
        JSON_HEX_APOS | 
        JSON_HEX_QUOT | 
        JSON_HEX_AMP ) ?>;
<<<<<<< HEAD

        window.caminhoAvatar = "<?= $caminhoAvatar ?>";
</script> 

<script src="<?= $caminhoAvatar ?>pixelArt/exibirAvatar.js" defer></script>
=======
</script> 

<script src="pixelArt/exibirAvatar.js" defer></script>
>>>>>>> 9166fdc3e638e90ba21be20bf495c68df467e9ad
