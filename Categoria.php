<?php
require_once 'basededatos.php';
class Categoria extends basededatos {
    public function mostrarCategorias() {
        try {
            $stmt = $this->conexion->query("SELECT * FROM categorias");
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categorias;
        } catch (PDOException $e) {
            return "Error al mostrar categorías: " . $e->getMessage();
        }
    }

    
public function añadirCategoria($nombre, $descripcion) {
    try {
        $stmt = $this->conexion->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
        $stmt->execute([$nombre, $descripcion]);
        return "Categoría añadida exitosamente";
    } catch (PDOException $e) {
        return "Error al añadir categoría: " . $e->getMessage();
    }
}

    public function modificarCategoria($idCategoria, $nombre, $descripcion) {
        try {
            $stmt = $this->conexion->prepare("UPDATE categorias SET nombre = ?, descripcion = ? WHERE id_categoria = ?");
            $stmt->execute([$nombre, $descripcion, $idCategoria]);
            return "Categoría modificada exitosamente";
        } catch (PDOException $e) {
            return "Error al modificar categoría: " . $e->getMessage();
        }
    }

    public function eliminarCategoria($idCategoria) {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM categorias WHERE id_categoria = ?");
            $stmt->execute([$idCategoria]);
            return "Categoría eliminada exitosamente";
        } catch (PDOException $e) {
            return "Error al eliminar categoría: " . $e->getMessage();
        }
    }
}
