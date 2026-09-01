<?php
session_start();
include("../conexao.php");

if (!isset($_SESSION["idUsuario"])) {
    header("Location: ../entrar.php");
    exit;
}

$idUsuario = $_SESSION["idUsuario"];

// idConteudo vem da URL (materias/portugues.php manda) ou do POST (ao responder)
$idConteudo = isset($_GET['conteudo']) ? (int) $_GET['conteudo'] : (int) ($_POST['idConteudo'] ?? 0);

if (!$idConteudo) {
    header("Location: ../paginainicial.php");
    exit;
}

// Dados do conteúdo (nome + explicação)
$stmt = $conexao->prepare("
    SELECT idMateria, nomeConteudo, explicacaoConteudo 
    FROM conteudo 
    WHERE idConteudo = ?
");

$stmt->bind_param("i", $idConteudo);
$stmt->execute();

$conteudo = $stmt->get_result()->fetch_assoc();

$idMateria = (int) $conteudo['idMateria'];

// Progresso desse conteúdo fica guardado na sessão (zera se o usuário entrar de novo depois)
if (!isset($_SESSION['quiz']) || ($_SESSION['quiz']['idConteudo'] ?? null) !== $idConteudo) {
    $_SESSION['quiz'] = [
        'idConteudo'  => $idConteudo,
        'respondidas' => [],
        'acertos'     => 0,
        'ordemAtual'  => null,
        'perguntaId'  => null,
    ];
}
$quiz = &$_SESSION['quiz'];

// Dados do conteúdo (nome + explicação)
$stmt = $conexao->prepare("SELECT nomeConteudo, explicacaoConteudo FROM conteudo WHERE idConteudo = ?");
$stmt->bind_param("i", $idConteudo);
$stmt->execute();
$conteudo = $stmt->get_result()->fetch_assoc();

// Vida e XP atuais do personagem
$stmt = $conexao->prepare("SELECT idPersonagem, vidaAtualPersonagem, xpPersonagem FROM personagem WHERE idUsuario = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$personagem = $stmt->get_result()->fetch_assoc();

$feedback = null; // 'correto' | 'errado'

// ---- Usuário acabou de responder uma pergunta ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
    $idQuestao = (int) $_POST['idQuestao'];
    $escolhida = (int) $_POST['resposta']; // 1 a 4

    $stmt = $conexao->prepare("SELECT respostaCorretaQuestao, xpQuestao FROM questao WHERE idQuestao = ?");
    $stmt->bind_param("i", $idQuestao);
    $stmt->execute();
    $questaoDb = $stmt->get_result()->fetch_assoc();

    if ($escolhida === (int) $questaoDb['respostaCorretaQuestao']) {
        $feedback = 'correto';
        $quiz['acertos']++;
        $personagem['xpPersonagem'] += (int) $questaoDb['xpQuestao'];
    } else {
        $feedback = 'errado';
        $personagem['vidaAtualPersonagem'] = max(0, $personagem['vidaAtualPersonagem'] - 5);
    }

    // Salva vida e xp atualizados no banco
    $stmt = $conexao->prepare("UPDATE personagem SET vidaAtualPersonagem = ?, xpPersonagem = ? WHERE idPersonagem = ?");
    $stmt->bind_param("iii", $personagem['vidaAtualPersonagem'], $personagem['xpPersonagem'], $personagem['idPersonagem']);
    $stmt->execute();

    $quiz['respondidas'][] = $idQuestao;
    $idQuestaoRespondida = $idQuestao;
}

$semVida = $personagem['vidaAtualPersonagem'] <= 0;

// ---- Escolhe a pergunta a ser exibida ----
$pergunta = null;
$opcoes = [];

if ($semVida) {
    // acabou a vida, não busca pergunta nova
} elseif ($feedback) {
    // acabou de responder: recarrega a MESMA pergunta pra mostrar o feedback
    $stmt = $conexao->prepare("SELECT * FROM questao WHERE idQuestao = ?");
    $stmt->bind_param("i", $idQuestaoRespondida);
    $stmt->execute();
    $pergunta = $stmt->get_result()->fetch_assoc();
    $opcoes = $quiz['ordemAtual']; // mantém a mesma ordem que o usuário viu
} else {
    // busca todas as perguntas ativas do conteúdo e sorteia uma que ainda não foi respondida
    $stmt = $conexao->prepare("SELECT * FROM questao WHERE idConteudo = ? AND statusQuestao = 'ativa'");
    $stmt->bind_param("i", $idConteudo);
    $stmt->execute();
    $todasQuestoes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $disponiveis = array_values(array_filter($todasQuestoes, function ($q) use ($quiz) {
        return !in_array($q['idQuestao'], $quiz['respondidas']);
    }));

    if (!empty($disponiveis)) {
        $pergunta = $disponiveis[array_rand($disponiveis)];

        // embaralha a ordem das 4 opções, mas guarda o número original (1-4) de cada uma
        $opcoes = [
            1 => $pergunta['opcao1Questao'],
            2 => $pergunta['opcao2Questao'],
            3 => $pergunta['opcao3Questao'],
            4 => $pergunta['opcao4Questao'],
        ];
        $chaves = array_keys($opcoes);
        shuffle($chaves);
        $embaralhadas = [];
        foreach ($chaves as $k) {
            $embaralhadas[$k] = $opcoes[$k];
        }
        $opcoes = $embaralhadas;

        $quiz['ordemAtual'] = $opcoes;
        $quiz['perguntaId'] = $pergunta['idQuestao'];
    }
}

$fimDoConteudo = !$semVida && !$pergunta && !$feedback;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title><?= htmlspecialchars($conteudo['nomeConteudo'] ?? 'Questão') ?></title>
</head>
<body>

<div class="quiz-box">

    <div class="quiz-topo">
        <h2 class="tituloCad2">Responda:</h2>
        <div class="quiz-vidas">❤️ <?= $personagem['vidaAtualPersonagem'] ?></div>
    </div>

    <?php if ($semVida): ?>
        <div class="quiz-fim">
            <h1 class="tituloCad2">Você ficou sem vidas!</h1>
            <p class="texto">Espere sua vida recarregar ou volte mais tarde.</p>
            <button onclick="window.location.href='../paginainicial.php'">Voltar</button>
        </div>

    <?php elseif ($fimDoConteudo): ?>
        <?php if ($idMateria == 1): ?>
            <div class="quiz-fim">
            <h1 class="tituloCad2">Conteúdo concluído!</h1>
            <p class="texto">Você acertou <?= $quiz['acertos'] ?> de <?= count($quiz['respondidas']) ?> perguntas.</p>
            <button onclick="window.location.href='../materias/portugues.php'">Voltar para Português</button>
        </div>

        <?php elseif ($idMateria == 2): ?>
            <div class="quiz-fim">
            <h1 class="tituloCad2">Conteúdo concluído!</h1>
            <p class="texto">Você acertou <?= $quiz['acertos'] ?> de <?= count($quiz['respondidas']) ?> perguntas.</p>
            <button onclick="window.location.href='../materias/ingles.php'">Voltar para Inglês</button>
        </div>

    <?php endif; ?>

    <?php else: ?>
        <div class="quiz-pergunta-area">
            <img class="quiz-personagem" src="../pixelArt/corpoCompleto.png" alt="Personagem">
            <div class="quiz-balao">
                <?= htmlspecialchars($pergunta['enunciadoQuestao']) ?>
            </div>
        </div>

        <?php if ($feedback): ?>
            <div class="quiz-feedback quiz-<?= $feedback ?>">
                <strong><?= $feedback === 'correto' ? 'Resposta correta!' : 'Resposta errada.' ?></strong>

                <?php if (!empty($conteudo['explicacaoConteudo'])): ?>
                    <p class="quiz-explicacao"><?= nl2br(htmlspecialchars($conteudo['explicacaoConteudo'])) ?></p>
                <?php endif; ?>
            </div>

            <button onclick="window.location.href='questao.php?conteudo=<?= $idConteudo ?>'">Próxima pergunta</button>

        <?php else: ?>
            <form method="POST" action="questao.php">
                <input type="hidden" name="idConteudo" value="<?= $idConteudo ?>">
                <input type="hidden" name="idQuestao" value="<?= $pergunta['idQuestao'] ?>">

                <?php foreach ($opcoes as $numeroOriginal => $texto): ?>
                    <button type="submit" name="resposta" value="<?= $numeroOriginal ?>">
                        <?= htmlspecialchars($texto) ?>
                    </button>
                <?php endforeach; ?>
            </form>

        <?php endif; ?>

    <?php endif; ?>

</div>

</body>
</html>