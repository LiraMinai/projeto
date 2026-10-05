<?php
session_start();
include_once "conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pegando os dados do formulário
    $nomeUsuario = trim($_POST['nomeUsuario'] ?? '');
    $nomeUsuarioUsuario = trim($_POST['nomeUsuarioUsuario'] ?? '');
    $emailUsuario = trim($_POST['emailUsuario'] ?? '');
    $senha = $_POST['senhaUsuario'] ?? '';

    // Verificando se algum campo está vazio
    if (
        $nomeUsuario === "" ||
        $nomeUsuarioUsuario === "" ||
        $emailUsuario === "" ||
        $senha === ""
    ) {
        $erro = "Preencha todos os campos para realizar o cadastro.";
    }

    // Verificando se o e-mail é válido
    elseif (!filter_var($emailUsuario, FILTER_VALIDATE_EMAIL)) {
        $erro = "Digite um e-mail válido.";
    }

    // Se não houver erro, realiza o cadastro
    else {

        $senhaUsuario = password_hash($senha, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuario 
        (nomeUsuario, nomeUsuarioUsuario, emailUsuario, senhaUsuario)
        VALUES (?, ?, ?, ?)";

        $stm = $conexao->prepare($query);

        $stm->bind_param(
            "ssss",
            $nomeUsuario,
            $nomeUsuarioUsuario,
            $emailUsuario,
            $senhaUsuario
        );

        if ($stm->execute()) {

            $_SESSION["idUsuario"] = $conexao->insert_id;

            header("Location: criacaopersonagem.php");
            exit;

        } else {
            $erro = "Erro ao realizar o cadastro: " . $stm->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>

<body>

<header class="cabecalho">

    <div class="logo">
        <img src="imagens/logo.png" alt="Logo">
        <h1 class="tituloCad">YDUTS</h1>
    </div>

    <h1 class="tituloCad2">CADASTRO</h1>

</header>

<div class="centralizar">

    <form method="POST">

        <p class="textodif">Nome</p>
        <input type="text" name="nomeUsuario" required>

        <p class="textodif">Nome de usuário</p>
        <input type="text" name="nomeUsuarioUsuario" required>

        <p class="textodif">E-mail</p>
        <input type="email" name="emailUsuario" required>

        <p class="textodif">Senha</p>
        <input type="password" name="senhaUsuario" required>

        <div class="faltapouco">
            <p class="textodif">
                Falta pouco para você começar sua aventura!
            </p>
        </div>

        <br>

        <button type="submit">Prosseguir</button>

    </form>

    <?php
    if (!empty($erro)) {
        echo "<p>$erro</p>";
    }
    ?>

</div>

</body>
</html>