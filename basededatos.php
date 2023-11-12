<?php
class basededatos {
    private $host = "localhost";
    private $usuario = "piero5";
    private $contrasena = "";
    private $bd = "bdtienda";

    protected $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->bd}", $this->usuario, $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
?>