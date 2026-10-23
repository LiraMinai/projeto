<?php
if (!defined('XP_POR_NIVEL')) {
    define('XP_POR_NIVEL', 100);
}

if (!function_exists('calcularNivel')) {
    function calcularNivel($xpTotal) {
        return (int) floor($xpTotal / XP_POR_NIVEL) + 1;
    }
}

if (!function_exists('progressoNivel')) {
    function progressoNivel($xpTotal) {
        $xpNoNivel = $xpTotal % XP_POR_NIVEL;
        return [
            'nivel'        => calcularNivel($xpTotal),
            'xpNoNivel'    => $xpNoNivel,
            'xpNecessario' => XP_POR_NIVEL,
            'porcentagem'  => (int) round($xpNoNivel / XP_POR_NIVEL * 100),
        ];
    }
}
?>