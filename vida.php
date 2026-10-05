<?php
function recarregarVida($conexao, $idPersonagem, $vidaAtual, $vidaMaxima, $ultimaRecarga) {
    $minutosPorVida = 30; // 1 vida a cada 30 minutos, ajusta como quiser

    if ($vidaAtual >= $vidaMaxima) {
        return $vidaAtual;
    }

    $agora = new DateTime();
    $ultima = $ultimaRecarga ? new DateTime($ultimaRecarga) : $agora;

    // Reset diário: se a última recarga foi num dia anterior, enche tudo
    if ($ultima->format('Y-m-d') < $agora->format('Y-m-d')) {
        $vidaAtual = $vidaMaxima;
        $ultima = $agora;
    } else {
        $minutosPassados = ($agora->getTimestamp() - $ultima->getTimestamp()) / 60;
        $vidasGanhas = (int) floor($minutosPassados / $minutosPorVida);

        if ($vidasGanhas > 0) {
            $vidaAtual = min($vidaMaxima, $vidaAtual + $vidasGanhas);
            // avança só o tempo já "gasto" nas vidas concedidas, guarda o resto pra próxima
            $ultima->modify('+' . ($vidasGanhas * $minutosPorVida) . ' minutes');
        }
    }

    $novaData = $ultima->format('Y-m-d H:i:s');
    $stmt = $conexao->prepare("UPDATE personagem SET vidaAtualPersonagem = ?, ultimaRecargaVidaPersonagem = ? WHERE idPersonagem = ?");
    $stmt->bind_param("isi", $vidaAtual, $novaData, $idPersonagem);
    $stmt->execute();

    return $vidaAtual;
}