<?php
include 'Usuario.php';

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $confirmarContrasena = $_POST['confirmar_contrasena'];

    $mensajeRegistro = $usuario->registrarUsuario($nick, $email, $contrasena, $confirmarContrasena);

    echo $mensajeRegistro;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<form action="formulario_registro.php" method="post">
    <h2>Registro</h2>
    <label for="nick">Nombre de usuario (nick):</label>
    <input type="text" name="nick" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required>
    <br>
    <label for="confirmar_contrasena">Confirmar Contraseña:</label>
    <input type="password" name="confirmar_contrasena" required>
    <br>
    <input type="submit" name="registrar" value="Registrarse">
</form>

</body>
</html>
