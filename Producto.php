<?php
require_once 'basededatos.php';
class Producto extends basededatos {

 public function mostrarProductos() {
        try {
            $stmt = $this->conexion->query("SELECT * FROM productos");
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $productos;
        } catch (PDOException $e) {
            return "Error al obtener productos: " . $e->getMessage();
        }
    }

    public function ordenarPorPrecio() {
        try {
            $stmt = $this->conexion->query("SELECT * FROM productos ORDER BY precio_unitario ASC");
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $productos;
        } catch (PDOException $e) {
            return "Error al ordenar productos por precio: " . $e->getMessage();
        }
    }

    public function añadirAlCarrito($idProducto, $cantidad) {
        try {
            $stmtStock = $this->conexion->prepare("SELECT stock, precio_unitario FROM productos WHERE id_producto = ?");
            $stmtStock->execute([$idProducto]);
            $producto = $stmtStock->fetch(PDO::FETCH_ASSOC);
    
            if ($producto && $producto['stock'] >= $cantidad) {
                $stmtUpdateStock = $this->conexion->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ?");
                $stmtUpdateStock->execute([$cantidad, $idProducto]);
    
                $precioUnitario = $producto['precio_unitario'];
                $precioTotal = $cantidad * $precioUnitario;
    
                $stmtInsertCarrito = $this->conexion->prepare("INSERT INTO carrito (producto, cantidad, precio_total) VALUES (?, ?, ?)");
                $stmtInsertCarrito->execute([$idProducto, $cantidad, $precioTotal]);
    
                return "Producto añadido al carrito exitosamente";
            } else {
                return "No hay suficiente stock disponible";
            }
        } catch (PDOException $e) {
            return "Error al añadir producto al carrito: " . $e->getMessage();
        }
    }    



    public function añadirProducto($nombre, $precio, $stock, $categoria) {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO productos (nombre, precio_unitario, stock, categoria) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nombre, $precio, $stock, $categoria]);
            return "Producto añadido exitosamente";
        } catch (PDOException $e) {
            return "Error al añadir producto: " . $e->getMessage();
        }
    }
    

    public function modificarProducto($idProducto, $nuevoNombre, $nuevoPrecio, $nuevoStock, $nuevaCategoria) {
        try {
            $stmt = $this->conexion->prepare("UPDATE productos SET nombre = ?, precio_unitario = ?, stock = ?, categoria = ? WHERE id_producto = ?");
            $stmt->execute([$nuevoNombre, $nuevoPrecio, $nuevoStock, $nuevaCategoria, $idProducto]);
            return "Producto modificado exitosamente";
        } catch (PDOException $e) {
            return "Error al modificar producto: " . $e->getMessage();
        }
    }

    public function eliminarProducto($idProducto) {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM productos WHERE id_producto = ?");
            $stmt->execute([$idProducto]);
            return "Producto eliminado exitosamente";
        } catch (PDOException $e) {
            return "Error al eliminar producto: " . $e->getMessage();
        }
    }


}

