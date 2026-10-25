<?php

require_once __DIR__ . "/nivel.php";

const DESBLOQUEIOS = [
    5  => ['regataAmarela', 'regataAzul', 'regataBranca', 'regataPreta',
           'regataRoxa', 'regataVerde', 'regataVermelha'],

    10  => ['estampa1', 'estampa2'],

    15 => ['estampa3', 'estampa4'],

    20 => ['saiaAzul', 'saiaBranca', 'saiaMarrom', 'saiaPreta', 'saiaRoxa'],

    25 => ['lacoCaveira'],

    30  => ['colarOuro'],

    35 => ['lacoVermelho'],

    40  => ['colarPrata'],

    45 => ['boneDipper'],

    50 => ['colarOuroDuplo', 'colarPrataDuplo']
];

const NOMES_ESPECIAIS = [
    'lacoCaveira'  => 'Laço Caveira',
    'lacoVermelho' => 'Laço Vermelho',
    'boneDipper'   => 'Boné Dipper',
    'colarOuroDuplo' => '2º Colar de Ouro',
    'colarPrataDuplo' => '2º Colar de Prata',
    'colarOuro' => 'Colar de Ouro',
    'colarPrata' => 'Colar de Prata',
    'regataAmarela' => 'Regata Amarela',
    'regataAzul' => 'Regata Azul',
    'regataBranca' => 'Regata Branca',
    'regataPreta' => 'Regata Preta',
    'regataRoxa' => 'Regata Roxa',
    'regataVerde' => 'Regata Verde',
    'regataVermelha' => 'Regata Vermelha',
    'saiaAzul' => 'Saia Azul',
    'saiaBranca' => 'Saia Branca',
    'saiaMarrom' => 'Saia Marrom',
    'saiaPreta' => 'Saia Preta',
    'saiaRoxa' => 'Saia Roxa',
    'estampa1' => 'Estampa 1',
    'estampa2' => 'Estampa 2',
    'estampa3' => 'Estampa 3',
    'estampa4' => 'Estampa 4'
];

// item => nível (montado uma vez só a partir de DESBLOQUEIOS)
function tabelaNiveis(): array {
    static $mapa = null;
    if ($mapa === null) {
        $mapa = [];
        foreach (DESBLOQUEIOS as $nivel => $itens) {
            foreach ($itens as $item) {
                $mapa[$item] = $nivel;
            }
        }
    }
    return $mapa;
}

function nivelMinimo(string $item): int {
    return tabelaNiveis()[$item] ?? 1;
}

function itemLiberado(string $item, int $nivel): bool {
    return $nivel >= nivelMinimo($item);
}

function validarItem(string $valor, string $padrao, int $nivel): string {
    return itemLiberado($valor, $nivel) ? $valor : $padrao;
}

function itensDesbloqueadosEntre(int $de, int $ate): array {
    $novos = [];
    foreach (DESBLOQUEIOS as $nivel => $itens) {
        if ($nivel > $de && $nivel <= $ate) {
            foreach ($itens as $item) {
                $novos[$item] = $nivel;
            }
        }
    }
    return $novos;
}

function opcao(string $valor, string $texto, int $nivel): string {
    if (!itemLiberado($valor, $nivel)) {
        return '';
    }
    return '<option value="' . htmlspecialchars($valor) . '">'
         . htmlspecialchars($texto) . '</option>';
}