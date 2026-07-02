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
    <h1 class="titulo">ENTRAR</h1>
    <form method="POST">
        <p class="textodif" name="nomeUsuario">Nome</p>
        <input type="text">
        <p class="textodif" name="nomeUsuarioUsuario">Nome de usuário</p>
        <input type="text">
        <p class="textodif" name="emailUsuario">E-mail</p>
        <input type="text">
        <p class="textodif" name="senhaUsuario">Senha</p>
        <input type="password">
        <br><br>
        <p class="textodif">Falta pouco para você começar sua aventura.</p>
        <br><br>
        <button type="submit">Prosseguir</button>
    </form>
    <?php
        $nomeUsuario = $_POST['nomeUsuario'];
        $nomeUsuarioUsuario = $_POST['nomeUsuarioUsuario'];
        $emailUsuario = $_POST['emailUsuario'];
        $senhaUsuario = $_POST['senhaUsuario'];

        include_once "conexao.php";

        $query = "INSERT INTO usuario (nomeUsuario, nomeUsuarioUsuario, emailUsuario, senhaUsuario) VALUES (?,?,?,?)";
        $stm = $db->prepare($query);
        $stm->bindParam(1, $nomeUsuario);
        $stm->bindParam(2, $nomeUsuarioUsuario);
        $stm->bindParam(3, $emailUsuario);
        $stm->bindParam(4, $senhaUsuario);

        if($stm->execute()){
            header('location:index.php');
        }
        else {
            print "<p>Erro ao inserir</p>";
        }
    ?>
</body>
</html>