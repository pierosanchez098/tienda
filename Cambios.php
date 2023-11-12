<?php
include 'Usuario.php';

$usuario = new Usuario();

$idUsuario = 8;

echo '<form method="post" action="">
        <input type="hidden" name="action" value="confirmarCerrarSesion">
        <input type="submit" value="Cerrar Sesión">
      </form>';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'confirmarCerrarSesion') {
    echo '<p>¿Estás seguro de que deseas cerrar sesión?</p>
            <form method="post" action="inicio.php">
                <input type="submit" name="confirmarCerrarSesion" value="Sí">
                <input type="button" value="No" onclick="history.back()">
            </form>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'cambiarDatosUsuario') {
    $nuevoEmail = $_POST['nuevoEmail'];
    $nuevaContrasena = $_POST['nuevaContrasena'];
    $confirmarContrasena = $_POST['confirmarContrasena'];

    $mensaje = $usuario->cambiarDatosUsuario($idUsuario, $nuevoEmail, $nuevaContrasena, $confirmarContrasena);
    echo '<p>' . $mensaje . '</p>';
}

echo '<h2>Cambiar datos del usuario</h2>';
echo '<form method="post" action="Cambios.php">
        <input type="hidden" name="action" value="cambiarDatosUsuario">
        <label for="nuevoEmail">Nuevo Email:</label>
        <input type="email" name="nuevoEmail" id="nuevoEmail" required>
        <br>
        <label for="nuevaContrasena">Nueva Contraseña:</label>
        <input type="password" name="nuevaContrasena" id="nuevaContrasena" required>
        <br>
        <label for="confirmarContrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmarContrasena" id="confirmarContrasena" required>
        <br>
        <input type="submit" value="Cambiar Datos">
    </form>';
?>
