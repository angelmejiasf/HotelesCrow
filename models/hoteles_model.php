<?php
class Hoteles_Model
{
    private $pdo;

    public function __construct($db)
    {

        $this->pdo = $db->getPDO();
    }

    /**
     * Obtiene la información de todos los hoteles desde la base de datos.
     *
     * @return array|bool Retorna un array con la información de todos los hoteles si la operación es exitosa; false si hay un error.
     */
    public function obtenerHoteles()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM hoteles");
            $stmt->execute();
            $hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $hoteles;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene la información de las habitaciones disponibles para un hotel específico desde la base de datos.
     *
     * @param int $idHotel El ID del hotel para el cual se desea obtener las habitaciones disponibles.
     * @return array|bool Retorna un array con la información de las habitaciones disponibles si la operación es exitosa; false si hay un error.
     */
    public function obtenerHabitacionesDisponibles($idHotel)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM habitaciones WHERE id_hotel = :idHotel");
            $stmt->bindParam(':idHotel', $idHotel, PDO::PARAM_INT);
            $stmt->execute();
            $habitaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $habitaciones;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene la información de un hotel por su ID desde la base de datos.
     *
     * @param int $idHotel El ID del hotel a obtener.
     * @return array|bool Retorna un array con la información del hotel si la operación es exitosa; false si hay un error.
     */
    public function getHotelPorId($idHotel)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM hoteles WHERE id = :id");
            $stmt->bindParam(':id', $idHotel);
            $stmt->execute();
            $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
            return $hotel;
        } catch (PDOException $e) {

            return false;
        }
    }

    /**
 * Obtiene la información de una habitación por su ID desde la base de datos.
 *
 * @param int $idHabitacion El ID de la habitación que se desea obtener.
 * @return array|null Retorna un array asociativo con la información de la habitación si se encuentra;
 *                 o null si no se encuentra la habitación o hay un error.
 */
public function getHabitacionPorId($idHabitacion)
{
    try {
        $stmt = $this->pdo->prepare("SELECT * FROM habitaciones WHERE id = :id");
        $stmt->bindParam(':id', $idHabitacion);
        $stmt->execute();
        $habitacion = $stmt->fetch(PDO::FETCH_ASSOC);
        return $habitacion;
    } catch (PDOException $e) {
        // Manejar cualquier excepción de PDO aquí, si es necesario
        return null;
    }
}

}
