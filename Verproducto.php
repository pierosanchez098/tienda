<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online - Ver Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<form method="post" action="Cambios.php">
    <input type="hidden" name="action" value="verPerfil">
    <input type="submit" value="Perfil">
</form>

<h1>Productos Disponibles</h1>

<?php
include 'Producto.php';
include 'Carrito.php';
include 'Usuario.php';

$usuario = new Usuario();

$producto = new Producto();

$carrito = new Carrito();

$idUsuario = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'añadirAlCarrito') {
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];

    $mensaje = $producto->añadirAlCarrito($idProducto, $cantidad);
    // Puedes mostrar un mensaje de éxito o error aquí según tus necesidades
    echo '<p>' . $mensaje . '</p>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'seleccionarProductos') {
    $orden = $_POST['orden'];

    switch ($orden) {
        case 'todos':
            $productos = $producto->mostrarProductos();
            break;
        case 'precio':
            $productos = $producto->ordenarPorPrecio();
            break;
        default:
            $productos = [];
            break;
    }
} else {
    $productos = $producto->mostrarProductos();
}

if (is_array($productos) && count($productos) > 0) {
    echo '<ul>';
    foreach ($productos as $producto) {
        echo '<li>' . $producto['nombre'] . ' - Precio: ' . $producto['precio_unitario'] . ' - Stock: ' . $producto['stock'] . '
              <form method="post" action="Verproducto.php">
                  <input type="hidden" name="action" value="añadirAlCarrito">
                  <input type="hidden" name="idProducto" value="' . $producto['id_producto'] . '">
                  <label for="cantidad">Cantidad:</label>
                  <input type="number" name="cantidad" id="cantidad" min="1" required>
                  <input type="submit" value="Añadir al carrito">
              </form>
          </li>';
    }
    echo '</ul>';
} else {
    echo 'No hay productos disponibles.';
}

echo '<form method="post" action="">
        <input type="hidden" name="action" value="seleccionarProductos">
        <label for="orden">Mostrar productos:</label>
        <select name="orden" id="orden">
            <option value="todos">Todos los productos</option>
            <option value="precio">Ordenar por precio (Menor a mayor)</option>
        </select>
        <input type="submit" value="Mostrar">
      </form>';


     
echo '<form method="post" action="Verproducto.php">
        <input type="hidden" name="action" value="mostrarCarrito">
        <input type="submit" value="Ver Carrito">
      </form>';

      

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'mostrarCarrito') {
    $productosCarrito = $carrito->mostrarCarrito();

    if (!empty($productosCarrito)) {
        echo '<h2>Productos en el Carrito</h2>';
        echo '<table border="1">
                <tr>
                    <th>ID Carrito</th>
                    <th>ID Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Total</th>
                </tr>';
        foreach ($productosCarrito as $producto) {
            echo '<tr>
                    <td>' . $producto['id_carrito'] . '</td>
                    <td>' . $producto['producto'] . '</td>
                    <td>' . $producto['cantidad'] . '</td>
                    <td>' . $producto['precio_total'] . '</td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo 'El carrito está vacío.';
    }
}

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


?>

</body>
</html>

