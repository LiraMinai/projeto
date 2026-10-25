<?php
session_start();
include("conexao.php");
require_once __DIR__ . "/desbloquear.php";

if (!isset($_SESSION["idUsuario"])) {
    header("Location: entrar.php");
    exit;
}

$idUsuario = $_SESSION["idUsuario"];

$stmt = $conexao->prepare("SELECT avatarPersonagem, xpPersonagem FROM personagem WHERE idUsuario = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$personagem = $stmt->get_result()->fetch_assoc();

if (!$personagem) {
    header("Location: criacaopersonagem.php");
    exit;
}

$avatarAtual = json_decode($personagem["avatarPersonagem"], true) ?? [];
$nivel = calcularNivel((int) $personagem["xpPersonagem"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $avatarPersonagem = json_encode([
        "cabelo"          => $_POST["cabelo"] ?? "nenhum",
        "corCabelo"       => $_POST["corCabelo"] ?? "#3B2A1A",
        "corOlhoEsquerdo" => $_POST["corOlhoEsquerdo"] ?? "#3B82F6",
        "corOlhoDireito"  => $_POST["corOlhoDireito"] ?? "#10B981",
        "heterocromia"    => ($_POST["heterocromia"] ?? "0") === "1",
        "corPele"         => $_POST["corPele"] ?? "#F8DCC8",
        "vitiligo"        => ($_POST["vitiligo"] ?? "0") === "1",
        "roupaSuperior"   => validarItem($_POST["roupaSuperior"] ?? "nenhuma", "nenhuma", $nivel),
        "roupaInferior"   => validarItem($_POST["roupaInferior"] ?? "nenhuma", "nenhuma", $nivel),
        "sapato"          => validarItem($_POST["sapato"] ?? "nenhum", "nenhum", $nivel),
        "estampa"         => validarItem($_POST["estampa"] ?? "nenhuma", "nenhuma", $nivel),
        "colar"           => validarItem($_POST["colar"] ?? "nenhum", "nenhum", $nivel),
        "acessorioCabeca" => validarItem($_POST["acessorioCabeca"] ?? "nenhum", "nenhum", $nivel),
    ]);

    $stmt = $conexao->prepare("UPDATE personagem SET avatarPersonagem = ? WHERE idUsuario = ?");
    $stmt->bind_param("si", $avatarPersonagem, $idUsuario);

    if ($stmt->execute()) {
        header("Location: paginainicial.php");
        exit;
    }
    echo "Erro ao salvar personagem: " . $stmt->error;
}

$stmt = $conexao->prepare("SELECT avatarPersonagem FROM personagem WHERE idUsuario = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$personagem = $stmt->get_result()->fetch_assoc();

if (!$personagem) {
    header("Location: criacaopersonagem.php");
    exit;
}

$avatarAtual = json_decode($personagem["avatarPersonagem"], true) ?? [];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Personagem</title>
        <link rel="icon" type="image/png" href="imagens/logo.png">
        <link rel="stylesheet" href="style.css">
        <script>
            window.avatarInicial = <?= json_encode($avatarAtual, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
        </script>
        <script src="pixelArt/script.js" defer></script>
        <style>
            canvas {
                image-rendering: pixelated;
            }
            /* preview maior, e acompanha a rolagem enquanto você mexe nas opções */
            #game {
                width: 450px;
                height: 450px;
                position: sticky;
                top: 20px;
            }
            .boxpixelart {
                height: auto;
                min-height: 700px;
                padding-bottom: 60px;
            }
            .editorPixelArt {
                display: flex;
                gap: 30px;
                align-items: flex-start;
                flex-wrap: wrap;
            }
            .editorPixelArt label {
                display: block;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <header>
        <div class= "logo">
            <img src="imagens/logo.png" alt="Logo">
            <h1 class="tituloCad">YDUTS</h1>
        </div>
        <h1 class="tituloCad3">EDITE SEU PERSONAGEM</h1>
    </header>
       

        <div class="boxpixelart">
        <form method="POST">

            <div class="editorPixelArt">
                <canvas id="game" width="300" height="300"></canvas>

                <div id="menu">
                    <label for="eyeColor" class=textoPersonagem>Cor do olho esquerdo</label>
                    <input type="color" id="eyeColor" value="#3B82F6">

                    <label class=textoPersonagem>
                        <label class='lblcheck'>Heterocromia</label>
                        <input type="checkbox" id="heterocromia">
                        
                    </label>

                    <div id="menuHeterocromia" style="display: none;">
                        <label for="eyeColorRight" class=textoPersonagem>Cor do olho direito</label><br>
                        <input type="color" id="eyeColorRight" value="#10B981">
                    </div>

                    <label for="skinColor" class=textoPersonagem>Cor da pele</label>
                    <select id="skinColor">
                        <option value="#F8DCC8">Pele 1</option>
                        <option value="#EFC4A4">Pele 2</option>
                        <option value="#D8A47F">Pele 3</option>
                        <option value="#BF8A63">Pele 4</option>
                        <option value="#A36A46">Pele 5</option>
                        <option value="#7A4D32">Pele 6</option>
                        <option value="#4B2C20">Pele 7</option>
                    </select>

                    <label class=textoPersonagem>
                        <label class='lblcheck'>Vitiligo</label>
                        <input type="checkbox" id="vitiligo">
                         
                    </label>

                    <label for="cabelos" class=textoPersonagem>Cabelo</label>
                    <select id="cabelos">
                        <option value="nenhum">Nenhum</option>
                        <optgroup label="Cabelos">
                            <option value="cabeloCrespo">Cabelo Crespo</option>
                            <option value="cabeloCurto">Cabelo Curto</option>
                            <option value="cabeloMedio">Cabelo Médio</option>
                            <option value="cabeloLongo">Cabelo Longo</option>
                            <option value="cabeloRaspadoLateral">Cabelo Lateral Raspada</option>
                            <option value="cabeloRaspado">Cabelo Raspado</option>
                        </optgroup>
                    </select>

                    <label for="hairColor" class=textoPersonagem>Cor do cabelo</label>
                    <input type="color" id="hairColor" value="#3B2A1A">

                    <label for="roupaSuperior" class=textoPersonagem>Roupa Superior</label>
                    <select id="roupaSuperior">
                        <option value="nenhuma">Nenhuma</option>
                        <optgroup label="Camisas manga longa">
                            <option value="camisaAmarela">Amarela</option>
                            <option value="camisaAzul">Azul</option>
                            <option value="camisaBranca">Branca</option>
                            <option value="camisaPreta">Preta</option>
                            <option value="camisaRoxa">Roxa</option>
                            <option value="camisaVerde">Verde</option>
                            <option value="camisaVermelha">Vermelha</option>
                        </optgroup>
                        <optgroup label="Camisetas manga curta:">
                            <option value="camisetaAmarela">Amarela</option>
                            <option value="camisetaAzul">Azul</option>
                            <option value="camisetaBranca">Branca</option>
                            <option value="camisetaPreta">Preta</option>
                            <option value="camisetaRoxa">Roxa</option>
                            <option value="camisetaVerde">Verde</option>
                            <option value="camisetaVermelha">Vermelha</option>
                        </optgroup>
                        <?php if (itemLiberado('regataAzul', $nivel)): ?>
                        <optgroup label="Regatas">
                            <?= opcao('regataAmarela',  'Regata Amarela',  $nivel) ?>
                            <?= opcao('regataAzul',     'Regata Azul',     $nivel) ?>
                            <?= opcao('regataBranca',   'Regata Branca',   $nivel) ?>
                            <?= opcao('regataPreta',    'Regata Preta',    $nivel) ?>
                            <?= opcao('regataRoxa',     'Regata Roxa',     $nivel) ?>
                            <?= opcao('regataVerde',    'Regata Verde',    $nivel) ?>
                            <?= opcao('regataVermelha', 'Regata Vermelha', $nivel) ?>
                        </optgroup>
                        <?php endif; ?>
                    </select>

                    <label for="roupaInferior" class=textoPersonagem>Roupa inferior</label>
                    <select id="roupaInferior">
                        <option value="nenhuma">Nenhuma</option>
                        <optgroup label="Bermudas">
                            <option value="bermudaAzul">Bermuda Azul</option>
                            <option value="bermudaBranca">Bermuda Branca</option>
                            <option value="bermudaMarrom">Bermuda Marrom</option>
                            <option value="bermudaPreta">Bermuda Preta</option>
                        </optgroup>
                        <optgroup label="Calças"> 
                            <option value="calcaAzul">Calça Azul</option>
                            <option value="calcaBranca">Calça Branca</option>
                            <option value="calcaMarrom">Calça Marrom</option>
                            <option value="calcaPreta">Calça Preta</option>
                        </optgroup>
                        <?php if (itemLiberado('saiaAzul', $nivel)): ?>
                        <optgroup label="Saias">
                            <?= opcao('saiaAzul',   'Saia Azul',   $nivel) ?>
                            <?= opcao('saiaBranca', 'Saia Branca', $nivel) ?>
                            <?= opcao('saiaMarrom', 'Saia Marrom', $nivel) ?>
                            <?= opcao('saiaPreta',  'Saia Preta',  $nivel) ?>
                            <?= opcao('saiaRoxa',   'Saia Roxa',   $nivel) ?>
                        </optgroup>
                        <?php endif; ?>
                    </select>

                    <label for="sapatos" class=textoPersonagem>Sapatos</label>
                    <select id="sapatos">
                        <option value="nenhum">Nenhum</option>
                        <optgroup label="Sapatos">
                            <option value="sapatoAzul">Sapato Azul</option>
                            <option value="sapatoBranco">Sapato Branco</option>
                            <option value="sapatoMarrom">Sapato Marrom</option>
                            <option value="sapatoVermelho">Sapato Vermelho</option>
                            <option value="sapatoPreto">Sapato Preto</option>
                        </optgroup>
                        <?php if (itemLiberado('estampa1', $nivel)): ?>
                    <label for="estampa" class=textoPersonagem>Estampa</label>
                    <select id="estampa">
                        <option value="nenhuma">Nenhuma</option>
                        <?= opcao('estampa1', 'Estampa 1', $nivel) ?>
                        <?= opcao('estampa2', 'Estampa 2', $nivel) ?>
                        <?= opcao('estampa3', 'Estampa 3', $nivel) ?>
                        <?= opcao('estampa4', 'Estampa 4', $nivel) ?>
                    </select>
                    <?php endif; ?>

                    <?php if (itemLiberado('colarOuro', $nivel)): ?>
                    <label for="colar" class=textoPersonagem>Colar</label>
                    <select id="colar">
                        <option value="nenhum">Nenhum</option>
                        <?= opcao('colarOuro',        'Colar de Ouro',         $nivel) ?>
                        <?= opcao('colarOuroDuplo',   '2º Colar de Ouro',   $nivel) ?>
                        <?= opcao('colarPrata',       'Colar de Prata',        $nivel) ?>
                        <?= opcao('colarPrataDuplo',  '2º Colar de Prata',  $nivel) ?>
                    </select>
                    <?php endif; ?>

                    <?php if (itemLiberado('lacoCaveira', $nivel)): ?>
                    <label for="acessorioCabeca" class=textoPersonagem>Acessório de cabeça</label>
                    <select id="acessorioCabeca">
                        <option value="nenhum">Nenhum</option>
                        <?= opcao('lacoCaveira',  'Laço Caveira',  $nivel) ?>
                        <?= opcao('boneDipper',   'Boné Dipper',   $nivel) ?>
                        <?= opcao('lacoVermelho', 'Laço Vermelho', $nivel) ?>
                    </select>
                    <?php endif; ?>
                    </select>
                </div>
            </div>
            <br>
            <input type="hidden" name="cabelo" id="campoCabelo">
            <input type="hidden" name="corCabelo" id="campoCorCabelo">
            <input type="hidden" name="corOlhoEsquerdo" id="campoCorOlhoEsquerdo">
            <input type="hidden" name="corOlhoDireito" id="campoCorOlhoDireito">
            <input type="hidden" name="heterocromia" id="campoHeterocromia">
            <input type="hidden" name="corPele" id="campoCorPele">
            <input type="hidden" name="vitiligo" id="campoVitiligo">
            <input type="hidden" name="roupaSuperior" id="campoRoupaSuperior">
            <input type="hidden" name="roupaInferior" id="campoRoupaInferior">
            <input type="hidden" name="sapato" id="campoSapato">
            <input type="hidden" name="estampa" id="campoEstampa">
            <input type="hidden" name="colar" id="campoColar">
            <input type="hidden" name="acessorioCabeca" id="campoAcessorioCabeca">

            
            <div class="centralizar" style="display:flex; gap:20px; justify-content:center;">
                <button type="button" onclick="window.location.href='paginainicial.php'">Cancelar</button>
                <button type="submit">Salvar alterações</button>
            </div>
        </form>
        </div>
    </body>
</html>