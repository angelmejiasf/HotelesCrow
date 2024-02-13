<?php
class Usuarios_Model
{
    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    /**
     * Obtiene un usuario por su nombre desde la base de datos.
     *
     * @param string $nombreUsuario El nombre del usuario a buscar.
     * @return array|bool Retorna un array asociativo con la información del usuario si se encuentra, o false si ocurre un error.
     */
    public function getUsuarioPorNombre($nombreUsuario)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE nombre = :nombre");
            $stmt->bindParam(':nombre', $nombreUsuario);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        } catch (PDOException $e) {

            return false;
        }
    }

    /**
     * Obtiene un usuario por su ID desde la base de datos.
     *
     * @param int $idUsuario El ID del usuario a buscar.
     * @return array|bool Retorna un array asociativo con la información del usuario si se encuentra, o false si ocurre un error.
     */
    public function getUsuarioPorId($idUsuario)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $idUsuario);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        } catch (PDOException $e) {

            return false;
        }
    }
}
