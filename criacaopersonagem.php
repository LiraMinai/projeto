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
    $avatarPersonagem = $_POST["avatarPersonagem"];

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
    </head>
    <body>
        <h1 class="tituloPersonagem">Crie seu personagem</h1>
        <div class="criacaoPersonagem">
        <form method="POST">
            <label class="textodif">Nome do personagem:</label>
            <input type="text" name="nomePersonagem" required>
            <br>
            <label class="textodif">Escolha seu avatar:</label>
            <input type="text" name="avatarPersonagem" value="img/avatar1.png">
            <br>
            </div>
            <div class="centralizar">
            <button type="submit">Criar personagem</button>
        </form>
    </div>
    </body>
</html>