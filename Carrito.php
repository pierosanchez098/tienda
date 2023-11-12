<?php
require_once 'basededatos.php';
class Carrito extends basededatos {
    public function mostrarCarrito() {
        try {
            $stmt = $this->conexion->query("SELECT id_carrito, producto, cantidad, precio_total FROM carrito");
            $productosCarrito = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $productosCarrito;
        } catch (PDOException $e) {
            return "Error al mostrar el carrito: " . $e->getMessage();
        }
    }

    public function eliminarDelCarrito($idCarrito) {
        try {
            $stmtProducto = $this->conexion->prepare("SELECT producto, cantidad FROM carrito WHERE id_carrito = ?");
            $stmtProducto->execute([$idCarrito]);
            $productoCarrito = $stmtProducto->fetch(PDO::FETCH_ASSOC);

            $stmtEliminar = $this->conexion->prepare("DELETE FROM carrito WHERE id_carrito = ?");
            $stmtEliminar->execute([$idCarrito]);

            $stmtActualizarStock = $this->conexion->prepare("UPDATE productos SET stock = stock + ? WHERE id_producto = ?");
            $stmtActualizarStock->execute([$productoCarrito['cantidad'], $productoCarrito['producto']]);

            return "Producto eliminado del carrito exitosamente";
        } catch (PDOException $e) {
            return "Error al eliminar producto del carrito: " . $e->getMessage();
        }
    }
}
