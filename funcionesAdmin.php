<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<form method="post" action="">
    <label for="opcion">Seleccionar operación (Usuarios):</label>
    <select name="opcion" id="opcion">
        <option value="mostrarUsuarios">Mostrar Usuarios</option>
        <option value="añadirUsuario">Añadir Usuario</option>
        <option value="modificarUsuario">Modificar Usuario</option>
        <option value="eliminarUsuario">Eliminar Usuario</option>
    </select>
    <input type="submit" value="Ejecutar">
</form>


<form method="post" action="">
    <label for="opcionCategorias">Seleccionar operación (Categorías):</label>
    <select name="opcionCategorias" id="opcionCategorias">
        <option value="mostrarCategorias">Mostrar categorias</option>
        <option value="añadirCategoria">Añadir categorias</option>
        <option value="modificarCategoria">Modificar categorias</option>
        <option value="eliminarCategoria">Eliminar categorias</option>
    </select>
    <input type="submit" value="Ejecutar">
</form>


<form method="post" action="">
    <label for="opcionProductos">Seleccionar operación (Productos):</label>
    <select name="opcionProductos" id="opcionProductos">
        <option value="mostrarProductos">Mostrar productos</option>
        <option value="añadirProducto">Añadir productos</option>
        <option value="modificarProducto">Modificar productos</option>
        <option value="eliminarProducto">Eliminar productos</option>
    </select>
    <input type="submit" value="Ejecutar">
</form>

<?php

include 'Usuario.php';

$usuario = new Usuario();

include 'Categoria.php';

$categoria = new Categoria();

include 'Producto.php';

$producto = new Producto();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['opcion'])) {
        $opcion = $_POST['opcion'];

        switch ($opcion) {
            case 'mostrarUsuarios':
                $usuarios = $usuario->mostrarUsuarios();

                echo '<table border="1">
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nick</th>
                            <th>Email</th>
                        </tr>';
        
                foreach ($usuarios as $usuario) {
                    echo '<tr>
                            <td>' . $usuario['id_usuario'] . '</td>
                            <td>' . $usuario['nick'] . '</td>
                            <td>' . $usuario['email'] . '</td>
                        </tr>';
                }
        
                echo '</table>';
                break;

            case 'añadirUsuario':
                 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'añadirUsuario') {
                          $nick = $_POST['nick'];
                             $email = $_POST['email'];
                           $contrasena = $_POST['contrasena'];
                      $confirmacionContrasena = $_POST['confirmacion_contrasena'];

            $mensaje = $usuario->añadirUsuario($nick, $email, $contrasena, $confirmacionContrasena);

            echo '<p>' . $mensaje . '</p>';
        }

        echo '<form method="post" action="">
                <input type="hidden" name="opcion" value="añadirUsuario">
                <input type="hidden" name="action" value="añadirUsuario">
                <label for="nick">Nick:</label>
                <input type="text" name="nick" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" required>
                <label for="confirmacion_contrasena">Confirmar Contraseña:</label>
                <input type="password" name="confirmacion_contrasena" required>
                <input type="submit" value="Añadir Usuario">
            </form>';
        break;

        case 'modificarUsuario':
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'modificarUsuario') {
                $idUsuario = $_POST['idUsuario']; 
                $nuevoNick = $_POST['nuevoNick'];
                $nuevoEmail = $_POST['nuevoEmail'];
                $nuevaContrasena = $_POST['nuevaContrasena'];
                $confirmacionContrasena = $_POST['confirmacion_nueva_contrasena'];
    
                $mensaje = $usuario->modificarUsuario($idUsuario, $nuevoNick, $nuevoEmail, $nuevaContrasena, $confirmacionContrasena);
    
                echo '<p>' . $mensaje . '</p>';
            }
    
            echo '<form method="post" action="">
                    <input type="hidden" name="opcion" value="modificarUsuario">
                    <input type="hidden" name="action" value="modificarUsuario">
                    <label for="idUsuario">ID de Usuario:</label>
                    <input type="text" name="idUsuario" required>
                    <label for="nuevoNick">Nuevo Nick:</label>
                    <input type="text" name="nuevoNick" required>
                    <label for="nuevoEmail">Nuevo Email:</label>
                    <input type="email" name="nuevoEmail" required>
                    <label for="nuevaContrasena">Nueva Contraseña:</label>
                    <input type="password" name="nuevaContrasena" required>
                    <label for="confirmacion_nueva_contrasena">Confirmar Nueva Contraseña:</label>
                    <input type="password" name="confirmacion_nueva_contrasena" required>
                    <input type="submit" value="Modificar Usuario">
                </form>';
            break;


            case 'eliminarUsuario':

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'eliminarUsuario') {
                    $idUsuarioEliminar = $_POST['idUsuarioEliminar']; 
        
                    $mensajeEliminar = $usuario->eliminarUsuario($idUsuarioEliminar);
        
                    echo '<p>' . $mensajeEliminar . '</p>';
                }
        
                echo '<form method="post" action="">
                        <input type="hidden" name="opcion" value="eliminarUsuario">
                        <input type="hidden" name="action" value="eliminarUsuario">
                        <label for="idUsuarioEliminar">ID de Usuario a Eliminar:</label>
                        <input type="text" name="idUsuarioEliminar" required>
                        <input type="submit" value="Eliminar Usuario">
                    </form>';
                break;

            default:
                echo "Opción no válida";
                break;
        }
    }
}


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcionCategorias'])) {
        $opcionCategorias = $_POST['opcionCategorias'];
    
        switch ($opcionCategorias) {
            case 'mostrarCategorias':
                $categorias = $categoria->mostrarCategorias();
                echo '<table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <!-- Agrega más columnas según tus necesidades -->
                        </tr>';
                foreach ($categorias as $categoria) {
                    echo '<tr>
                            <td>' . $categoria['id_categoria'] . '</td>
                            <td>' . $categoria['nombre'] . '</td>
                            <td>' . $categoria['descripcion'] . '</td>
                            <!-- Agrega más celdas según tus necesidades -->
                        </tr>';
                }
                echo '</table>';
                break;


                case 'añadirCategoria':
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcionCategorias']) && $_POST['opcionCategorias'] === 'añadirCategoria') {
                        $nombreCategoria = isset($_POST['nombreCategoria']) ? $_POST['nombreCategoria'] : '';
                        $descripcionCategoria = isset($_POST['descripcionCategoria']) ? $_POST['descripcionCategoria'] : '';
                
                        if (!empty($nombreCategoria) && !empty($descripcionCategoria)) {
                            $mensaje = $categoria->añadirCategoria($nombreCategoria, $descripcionCategoria);
                
                            echo $mensaje;
                        } else {
                            echo "Por favor, completa todos los campos.";
                        }
                    }
                
                    echo '<form method="post" action="">
                            <label for="nombreCategoria">Nombre de la categoría:</label>
                            <input type="text" name="nombreCategoria" required>
                            <br>
                            <label for="descripcionCategoria">Descripción de la categoría:</label>
                            <input type="text" name="descripcionCategoria" required>
                            <br>
                            <input type="hidden" name="opcionCategorias" value="añadirCategoria">
                            <input type="submit" value="Añadir Categoría">
                          </form>';
                    break;

            case 'modificarCategoria':
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcionCategorias']) && $_POST['opcionCategorias'] === 'modificarCategoria') {
        $idCategoriaModificar = isset($_POST['idCategoriaModificar']) ? $_POST['idCategoriaModificar'] : '';
        $nombreCategoriaModificar = isset($_POST['nombreCategoriaModificar']) ? $_POST['nombreCategoriaModificar'] : '';
        $descripcionCategoriaModificar = isset($_POST['descripcionCategoriaModificar']) ? $_POST['descripcionCategoriaModificar'] : '';

        if (!empty($idCategoriaModificar) && !empty($nombreCategoriaModificar) && !empty($descripcionCategoriaModificar)) {
            $mensaje = $categoria->modificarCategoria($idCategoriaModificar, $nombreCategoriaModificar, $descripcionCategoriaModificar);

            echo $mensaje;
        } else {
            echo "Por favor, selecciona una categoría y completa todos los campos.";
        }
    }

    echo '<form method="post" action="">
            <label for="idCategoriaModificar">Selecciona una categoría:</label>
            <select name="idCategoriaModificar">';
            
    $categorias = $categoria->mostrarCategorias();
    foreach ($categorias as $cat) {
        echo '<option value="' . $cat['id_categoria'] . '">' . $cat['nombre'] . '</option>';
    }

    echo '</select>
            <br>
            <label for="nombreCategoriaModificar">Nuevo nombre de la categoría:</label>
            <input type="text" name="nombreCategoriaModificar" required>
            <br>
            <label for="descripcionCategoriaModificar">Nueva descripción de la categoría:</label>
            <input type="text" name="descripcionCategoriaModificar" required>
            <br>
            <input type="hidden" name="opcionCategorias" value="modificarCategoria">
            <input type="submit" value="Modificar Categoría">
          </form>';
    break;


            case 'eliminarCategoria':
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcionCategorias']) && $_POST['opcionCategorias'] === 'eliminarCategoria') {
        $idCategoriaEliminar = isset($_POST['idCategoriaEliminar']) ? $_POST['idCategoriaEliminar'] : '';

        if (!empty($idCategoriaEliminar)) {
            $mensaje = $categoria->eliminarCategoria($idCategoriaEliminar);

            echo $mensaje;
        } else {
            echo "Por favor, selecciona una categoría.";
        }
    }

    echo '<form method="post" action="">
            <label for="idCategoriaEliminar">Selecciona una categoría:</label>
            <select name="idCategoriaEliminar">';

    $categorias = $categoria->mostrarCategorias();
    foreach ($categorias as $cat) {
        echo '<option value="' . $cat['id_categoria'] . '">' . $cat['nombre'] . '</option>';
    }

    echo '</select>
            <br>
            <input type="hidden" name="opcionCategorias" value="eliminarCategoria">
            <input type="submit" value="Eliminar Categoría">
          </form>';
    break;

}
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['opcionProductos'])) {
            $opcionProductos = $_POST['opcionProductos'];
    
            switch ($opcionProductos) {
                case 'mostrarProductos':
                    $productos = $producto->mostrarProductos();
                    
                    if (!empty($productos)) {
                        echo '<table border="1">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Categoría</th>
                                </tr>';
                        foreach ($productos as $producto) {
                            echo '<tr>
                                    <td>' . $producto['id_producto'] . '</td>
                                    <td>' . $producto['nombre'] . '</td>
                                    <td>' . $producto['precio_unitario'] . '</td>
                                    <td>' . $producto['stock'] . '</td>';
                            
                            if (isset($producto['id_categoria'])) {
                                echo '<td>' . $producto['id_categoria'] . '</td>';
                            } else {
                                echo '<td>NA</td>'; 
                            }
                
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo 'No hay productos para mostrar.';
                    }
                    break;

                    
                    case 'añadirProducto':
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcionProductos']) && $_POST['opcionProductos'] === 'añadirProducto') {
                            if (isset($_POST['nombreProducto'], $_POST['precioProducto'], $_POST['stockProducto'], $_POST['nombreCategoriaProducto'])) {
                                $nombreProducto = $_POST['nombreProducto'];
                                $precioProducto = $_POST['precioProducto'];
                                $stockProducto = $_POST['stockProducto'];
                                $nombreCategoriaProducto = $_POST['nombreCategoriaProducto'];
                    
                                $mensaje = $producto->añadirProducto($nombreProducto, $precioProducto, $stockProducto, $nombreCategoriaProducto);
                    
                                echo $mensaje;
                            } else {
                                echo "Campos del formulario no definidos correctamente.";
                            }
                        }
                    
                        echo '<form method="post" action="">
        <label for="nombreProducto">Nombre del producto:</label>
        <input type="text" name="nombreProducto" required>
        <br>
        <label for="precioProducto">Precio del producto:</label>
        <input type="number" name="precioProducto" min="0" step="0.01" required>
        <br>
        <label for="stockProducto">Stock del producto:</label>
        <input type="number" name="stockProducto" min="0" required>
        <br>
        <label for="nombreCategoriaProducto">Nombre de la categoría:</label>
        <input type="text" name="nombreCategoriaProducto" required>
        <br>
        <input type="hidden" name="opcionProductos" value="añadirProducto">
        <input type="submit" value="Añadir Producto">
    </form>';
                        break;
                    
                    
                    
                
                        case 'modificarProducto':
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcionProductos']) && $_POST['opcionProductos'] === 'modificarProducto') {
                                $idProductoModificar = $_POST['idProductoModificar'] ?? '';  
                                $nombreProductoModificar = $_POST['nombreProductoModificar'] ?? '';
                                $precioProductoModificar = $_POST['precioProductoModificar'] ?? '';
                                $stockProductoModificar = $_POST['stockProductoModificar'] ?? '';
                                $categoriaProductoModificar = $_POST['categoriaProductoModificar'] ?? '';
                        
                          
                                $mensaje = $producto->modificarProducto($idProductoModificar, $nombreProductoModificar, $precioProductoModificar, $stockProductoModificar, $categoriaProductoModificar);
                        
                              
                                echo $mensaje;
                            }
                        
                            echo '<form method="post" action="">
                                    <label for="idProductoModificar">ID del producto a modificar:</label>
                                    <input type="number" name="idProductoModificar" min="1" required>
                                    <br>
                                    <label for="nombreProductoModificar">Nuevo nombre del producto:</label>
                                    <input type="text" name="nombreProductoModificar" required>
                                    <br>
                                    <label for="precioProductoModificar">Nuevo precio del producto:</label>
                                    <input type="number" name="precioProductoModificar" min="0" step="0.01" required>
                                    <br>
                                    <label for="stockProductoModificar">Nuevo stock del producto:</label>
                                    <input type="number" name="stockProductoModificar" min="0" required>
                                    <br>
                                    <label for="categoriaProductoModificar">Nuevo categoría:</label>
                                    <input type="text" name="categoriaProductoModificar" required>
                                    <br>
                                    <input type="hidden" name="opcionProductos" value="modificarProducto">
                                    <input type="submit" value="Modificar Producto">
                                </form>';
                            break;
                        
                        

                    
                            case 'eliminarProducto':
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcionProductos']) && $_POST['opcionProductos'] === 'eliminarProducto') {
                                    $idProductoEliminar = $_POST['idProductoEliminar'] ?? '';  
                            

                                    $mensaje = $producto->eliminarProducto($idProductoEliminar);
                            
                                    echo $mensaje;
                                }
                            
                                echo '<form method="post" action="">
                                        <label for="idProductoEliminar">ID del producto a eliminar:</label>
                                        <input type="number" name="idProductoEliminar" min="1" required>
                                        <br>
                                        <input type="hidden" name="opcionProductos" value="eliminarProducto">
                                        <input type="submit" value="Eliminar Producto">
                                    </form>';
                                break;
                            
                    
                default:
                    echo "Opción no válida";
                    break;
            }
        }
    }

?>

</body>

</html>