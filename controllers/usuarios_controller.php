<?php
class Usuarios_Controller
{

    private $usuariosModel;

    public function __construct($usuariosModel)
    {
        $this->usuariosModel = $usuariosModel;
    }

    /**
     * Verifica las credenciales del usuario para el inicio de sesión.
     *
     * @param string $nombreUsuario El nombre de usuario proporcionado.
     * @param string $contrasena La contraseña proporcionada.
     * @return bool Retorna true si las credenciales son válidas; false si no lo son.
     */
    public function login($nombreUsuario, $contrasena)
    {
        $usuario = $this->usuariosModel->getUsuarioPorNombre($nombreUsuario);


        return $usuario && hash('sha256', $contrasena) === $usuario['contraseña'];
    }

    /**
     * Obtiene el ID de un usuario por su nombre desde el modelo de usuarios.
     *
     * @param string $nombreUsuario El nombre de usuario del cual obtener el ID.
     * @return int|null Retorna el ID del usuario si existe; null si no existe o hay un error.
     */
    public function obtenerIdUsuarioPorNombre($nombreUsuario)
    {
        try {
            $usuario = $this->usuariosModel->getUsuarioPorNombre($nombreUsuario);

            if ($usuario) {
                return $usuario['id'];
            }

            return null;
        } catch (PDOException $e) {

            return null;
        }
    }

    /**
     * Obtiene el nombre de usuario por su ID desde el modelo de usuarios.
     *
     * @param int $idUsuario El ID del usuario del cual obtener el nombre.
     * @return string|null Retorna el nombre del usuario si existe; null si no existe o hay un error.
     */
    public function obtenerNombreUsuarioPorId($idUsuario)
    {
        try {
            $usuario = $this->usuariosModel->getUsuarioPorId($idUsuario);

            if ($usuario) {
                return $usuario['nombre'];
            }

            return null;
        } catch (PDOException $e) {

            return null;
        }
    }
}
