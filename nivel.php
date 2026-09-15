<?php
function calcularNivel($xpTotal) {
    $xpPorNivel = 100; // ajusta esse número se quiser níveis mais rápidos/lentos
    return (int) floor($xpTotal / $xpPorNivel) + 1;
}