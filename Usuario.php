<?php

require_once 'basededatos.php';

class Usuario extends basededatos {
    public function registrarUsuario($nick, $email, $contrasena, $confirmarContrasena) {
        if ($contrasena !== $confirmarContrasena) {
            return "Las contraseñas no coinciden";
        }

        $hashContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

        try {
            $stmt = $this->conexion->prepare("INSERT INTO usuario (nick, email, contrasena) VALUES (?, ?, ?)");
            $stmt->execute([$nick, $email, $hashContrasena]);
            return "Registro exitoso";
        } catch (PDOException $e) {
            return "Error al registrar usuario: " . $e->getMessage();
        }
    }

    public function loginUsuario($nick, $contrasena) {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE nick = ?");
            $stmt->execute([$nick]);
    
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                session_start();
    
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nick'] = $usuario['nick'];
    
                if ($usuario['nick'] === 'administrador') {
                    header("Location: funcionesAdmin.php");
                    exit();
                } else {
                    header("Location: Verproducto.php");
                    exit();
                }
            } else {
                return "Credenciales incorrectas. Inténtalo de nuevo.";
            }
        } catch (PDOException $e) {
            return "Error al iniciar sesión: " . $e->getMessage();
        }
    }
    



    public function cambiarDatosUsuario($idUsuario, $nuevoEmail, $nuevaContrasena, $confirmarContrasena) {
        if ($nuevaContrasena !== $confirmarContrasena) {
            return "Las contraseñas no coinciden";
        }

        $hashContrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        try {
            $stmt = $this->conexion->prepare("UPDATE usuario SET email = ?, contrasena = ? WHERE id_usuario = ?");
            $stmt->execute([$nuevoEmail, $hashContrasena, $idUsuario]);
            return "Datos modificados exitosamente";
        } catch (PDOException $e) {
            return "Error al modificar datos del usuario: " . $e->getMessage();
        }
    }

    public function mostrarUsuarios() {
        try {
            $stmt = $this->conexion->query("SELECT * FROM usuario");
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        } catch (PDOException $e) {
            return "Error al mostrar usuarios: " . $e->getMessage();
        }
    }

    public function añadirUsuario($nick, $email, $contrasena) {
        $hashContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

        try {
            $stmt = $this->conexion->prepare("INSERT INTO usuario (nick, email, contrasena) VALUES (?, ?, ?)");
            $stmt->execute([$nick, $email, $hashContrasena]);
            return "Usuario añadido exitosamente";
        } catch (PDOException $e) {
            return "Error al añadir usuario: " . $e->getMessage();
        }
    }

    public function modificarUsuario($idUsuario, $nuevoNick, $nuevoEmail, $nuevaContrasena) {
        try {
            if (!empty($nuevaContrasena)) {
                $hashContrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

                $stmt = $this->conexion->prepare("UPDATE usuario SET nick = ?, email = ?, contrasena = ? WHERE id_usuario = ?");
                $stmt->execute([$nuevoNick, $nuevoEmail, $hashContrasena, $idUsuario]);
            } else {
                $stmt = $this->conexion->prepare("UPDATE usuario SET nick = ?, email = ? WHERE id_usuario = ?");
                $stmt->execute([$nuevoNick, $nuevoEmail, $idUsuario]);
            }

            return "Usuario modificado exitosamente";
        } catch (PDOException $e) {
            return "Error al modificar usuario: " . $e->getMessage();
        }
    }

    public function eliminarUsuario($idUsuario) {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM usuario WHERE id_usuario = ?");
            $stmt->execute([$idUsuario]);

            return "Usuario eliminado exitosamente";
        } catch (PDOException $e) {
            return "Error al eliminar usuario: " . $e->getMessage();
        }
    }
}
?>
