<?php
session_start();
include("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Entrar</title>
</head>
<body>
    <header>
        <div class= "logo">
            <img class='img-logo' src="imagens/logo.png">
            <h1 class="titulo">YDUTS</h1>
        </div>
        <h1 class="titulo">ENTRAR</h1>
    </header>
    <form method="POST">
        <p class="textodif">E-mail</p>
        <input class="questionario" type="text" name="emailUsuario">
        <p class="textodif">Senha</p>
        <input class="questionario" type="password" name="senhaUsuario">
        <br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["emailUsuario"];
    $senha = $_POST["senhaUsuario"];

    $sql = "SELECT * FROM usuario WHERE emailUsuario = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if (password_verify($senha, $usuario["senhaUsuario"])) {

            $_SESSION["idUsuario"] = $usuario["idUsuario"];
            echo "<pre>";
            var_dump($_SESSION);
            echo "</pre>";

            exit;

            header("Location: paginainicial.php");
            exit;

        } else {
            echo "Senha incorreta!";
        }

    } else {
        echo "Usuário não encontrado!";
    }
}
?>