<?php
function verificarCheckin($conexao, $idUsuario, $ultimoCheckinStr, $sequencia) {
    $hoje = new DateTime();
    $ultimoCheckin = $ultimoCheckinStr ? new DateTime($ultimoCheckinStr) : null;

    // já fez check-in hoje, não mexe em nada
    if ($ultimoCheckin !== null && $ultimoCheckin->format('Y-m-d') === $hoje->format('Y-m-d')) {
        return $sequencia;
    }

    if ($ultimoCheckin !== null) {
        $ontem = (clone $hoje)->modify('-1 day');
        $sequencia = ($ultimoCheckin->format('Y-m-d') === $ontem->format('Y-m-d'))
            ? $sequencia + 1  // check-in em dias seguidos
            : 1;              // pulou um dia, quebrou a sequência
    } else {
        $sequencia = 1; // primeiro check-in de todos
    }

    $hojeStr = $hoje->format('Y-m-d');
    $stmt = $conexao->prepare("UPDATE usuario SET sequenciaCheckinUsuario = ?, ultimoCheckinUsuario = ?, melhorSequenciaUsuario = GREATEST(melhorSequenciaUsuario, ?) WHERE idUsuario = ?");
    $stmt->bind_param("isii", $sequencia, $hojeStr, $sequencia, $idUsuario);
    $stmt->execute();

    return $sequencia;
}