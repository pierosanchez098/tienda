<?php
include 'Usuario.php';

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $nickLogin = $_POST['nick_login'];
    $contrasenaLogin = $_POST['contrasena_login'];

    $mensajeLogin = $usuario->loginUsuario($nickLogin, $contrasenaLogin);

    if (strpos($mensajeLogin, 'Inicio de sesión exitoso') !== false) {
        header("Location: Verproducto.php");
        exit; 
    }

    echo $mensajeLogin;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<form action="formulario_login.php" method="post">
    <h2>Login</h2>
    <label for="nick_login">Nombre de usuario (nick):</label>
    <input type="text" name="nick_login" required>
    <br>
    <label for="contrasena_login">Contraseña:</label>
    <input type="password" name="contrasena_login" required>
    <br>
    <input type="submit" name="login" value="Login">
</form>

</body>
</html>
