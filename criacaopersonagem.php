<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["idUsuario"])) {
    header("Location: entrar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_SESSION["idUsuario"];
    $nomePersonagem = $_POST["nomePersonagem"];
    $avatarPersonagem = json_encode([
        "cabelo"           => $_POST["cabelo"] ?? "nenhum",
        "corCabelo"        => $_POST["corCabelo"] ?? "#3B2A1A",
        "corOlhoEsquerdo"  => $_POST["corOlhoEsquerdo"] ?? "#3B82F6",
        "corOlhoDireito"   => $_POST["corOlhoDireito"] ?? "#10B981",
        "heterocromia"     => ($_POST["heterocromia"] ?? "0") === "1",
        "corPele"          => $_POST["corPele"] ?? "#F8DCC8",
        "vitiligo"         => ($_POST["vitiligo"] ?? "0") === "1",
        "roupaSuperior"    => $_POST["roupaSuperior"] ?? "nenhuma",
        "roupaInferior"    => $_POST["roupaInferior"] ?? "nenhuma",
        "sapato"           => $_POST["sapato"] ?? "nenhum",
    ]);

    $sql = "INSERT INTO personagem 
    (idUsuario, nomePersonagem, avatarPersonagem, ultimaRecargaVidaPersonagem)
    VALUES (?, ?, ?, NOW())";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param(
        "iss",
        $idUsuario,
        $nomePersonagem,
        $avatarPersonagem
    );

    if ($stmt->execute()) {
        header("Location: paginainicial.php");
        exit;
    } else {
        echo "Erro ao criar personagem: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Criar Personagem</title>
        <link rel="stylesheet" href="style.css">
        <script src="pixelArt/script.js" defer></script>
        <style>
            canvas {
                image-rendering: pixelated;
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
        <h1 class="tituloPersonagem">Crie seu personagem</h1>

        <form method="POST">
            <div class="criacaoPersonagem">
                <label class="textodif">Nome do personagem:</label>
                <input type="text" name="nomePersonagem" required>
            </div>

            <div class="editorPixelArt">
                <canvas id="game" width="320" height="320"></canvas>

                <div id="menu">
                    <label for="eyeColor" class=textoPersonagem>Cor do olho esquerdo</label>
                    <input type="color" id="eyeColor" value="#3B82F6">

                    <label>
                        <input type="checkbox" id="heterocromia">
                        Heterocromia
                    </label>

                    <div id="menuHeterocromia" style="display: none;">
                        <label for="eyeColorRight" class=textoPersonagem>Cor do olho direito</label>
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

                    <label>
                        <input type="checkbox" id="vitiligo">
                        Vitiligo
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
                        <optgroup label="Calças" class=textoPersonagem> 
                            <option value="calcaAzul">Calça Azul</option>
                            <option value="calcaBranca">Calça Branca</option>
                            <option value="calcaMarrom">Calça Marrom</option>
                            <option value="calcaPreta">Calça Preta</option>
                        </optgroup>
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
                    </select>
                </div>
            </div>

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


            <div class="centralizar">
                <button type="submit">Criar personagem</button>
            </div>
        </form>
    </body>
</html>