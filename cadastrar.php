<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>
<body>
    <img src="imagens/logo.png">
    <h1 class="titulo">YDUTS</h1>
    <h1 class="titulo">CADASTRO</h1>
    <div class="centralizar">
    <form method="POST">
        <p class="textodif">Nome</p>
        <input type="text" name="nomeUsuario">
        <p class="textodif">Nome de usuário</p>
        <input type="text" name="nomeUsuarioUsuario">
        <p class="textodif">E-mail</p>
        <input type="text" name="emailUsuario">
        <p class="textodif">Senha</p>
        <input type="password" name="senhaUsuario">
        <br><br>
    </div>
    <div class="faltapouco">
        <p class="textodif">Falta pouco para você começar sua aventura!</p>
        <br><br>
    </div>
    <div class="centralizar">
        <button type="submit">Prosseguir</button>
    </form>
    </div>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nomeUsuario = $_POST['nomeUsuario'];
        $nomeUsuarioUsuario = $_POST['nomeUsuarioUsuario'];
        $emailUsuario = $_POST['emailUsuario'];
        $senhaUsuario = password_hash($_POST["senhaUsuario"], PASSWORD_DEFAULT);

        include_once "conexao.php";

        $query = "INSERT INTO usuario (nomeUsuario, nomeUsuarioUsuario, emailUsuario, senhaUsuario)
                VALUES (?,?,?,?)";

        $stm = $conexao->prepare($query);

        $stm->bind_param(
            "ssss",
            $nomeUsuario,
            $nomeUsuarioUsuario,
            $emailUsuario,
            $senhaUsuario
        );
        
        if($stm->execute()){
            header("Location: criacaopersonagem.php");
            exit;
        } else {
            echo "<p>Erro ao inserir</p>";
        }
    }
    ?>
</body>
</html>