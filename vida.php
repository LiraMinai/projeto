
<?php

function recarregarVida($conexao, $idPersonagem, $vidaAtual, $vidaMaxima, $ultimaRecarga) {
    $minutosPorRecarga = 30;
    $pontosPorRecarga = 5;

    $vidaAtual = (int) $vidaAtual;
    $vidaMaxima = (int) $vidaMaxima;

    // Se a vida já estiver cheia, não há nada para recuperar.
    if ($vidaAtual >= $vidaMaxima) {
        return $vidaMaxima;
    }

    $agora = new DateTime();

    // Se não houver uma data registrada, inicia a contagem agora.
    if (empty($ultimaRecarga)) {
        $ultima = clone $agora;

        $novaData = $ultima->format('Y-m-d H:i:s');

        $stmt = $conexao->prepare(
            "UPDATE personagem
             SET ultimaRecargaVidaPersonagem = ?
             WHERE idPersonagem = ?"
        );

        $stmt->bind_param("si", $novaData, $idPersonagem);
        $stmt->execute();
        $stmt->close();

        return $vidaAtual;
    }

    $ultima = new DateTime($ultimaRecarga);

    $segundosPassados = max(
        0,
        $agora->getTimestamp() - $ultima->getTimestamp()
    );

    $segundosPorRecarga = $minutosPorRecarga * 60;

    // Conta somente os intervalos completos de 30 minutos.
    $intervalos = intdiv($segundosPassados, $segundosPorRecarga);

    if ($intervalos <= 0) {
        return $vidaAtual;
    }

    // Recupera 5 pontos por intervalo, respeitando o máximo.
    $vidaAtual = min(
        $vidaMaxima,
        $vidaAtual + ($intervalos * $pontosPorRecarga)
    );

    if ($vidaAtual >= $vidaMaxima) {
        // Ao encher a vida, encerra o ciclo atual.
        $ultima = clone $agora;
    } else {
        // Preserva os minutos restantes para a próxima recarga.
        $ultima->modify(
            '+' . ($intervalos * $minutosPorRecarga) . ' minutes'
        );
    }

    $novaData = $ultima->format('Y-m-d H:i:s');

    $stmt = $conexao->prepare(
        "UPDATE personagem
         SET vidaAtualPersonagem = ?,
             ultimaRecargaVidaPersonagem = ?
         WHERE idPersonagem = ?"
    );

    $stmt->bind_param(
        "isi",
        $vidaAtual,
        $novaData,
        $idPersonagem
    );

    $stmt->execute();
    $stmt->close();

    return $vidaAtual;
}
