<?php
class Hotel_Controller
{
    private $hotelesModel;

    public function __construct($hotelesModel)
    {
        $this->hotelesModel = $hotelesModel;
    }

    /**
     * Obtiene la información de todos los hoteles desde el modelo de hoteles.
     *
     * @return array|bool Retorna un array con la información de todos los hoteles si la operación es exitosa; false si hay un error.
     */
    public function listarHoteles()
    {
        $hoteles = $this->hotelesModel->obtenerHoteles();
        return $hoteles;
    }

    /**
     * Obtiene la información de las habitaciones disponibles para un hotel específico desde el modelo de hoteles.
     *
     * @param int $idHotel El ID del hotel para el cual se desea obtener las habitaciones disponibles.
     * @return array|bool Retorna un array con la información de las habitaciones disponibles si la operación es exitosa; false si hay un error.
     */
    public function obtenerHabitacionesDisponibles($idHotel)
    {


        return $this->hotelesModel->obtenerHabitacionesDisponibles($idHotel);
    }

    /**
     * Obtiene el nombre de un hotel por su ID desde el modelo de hoteles.
     *
     * @param int $idHotel El ID del hotel del cual obtener el nombre.
     * @return string|null Retorna el nombre del hotel si existe; null si no existe o hay un error.
     */
    public function obtenerNombreHotelPorId($idHotel)
    {
        try {
            $hotel = $this->hotelesModel->getHotelPorId($idHotel);

            if ($hotel) {
                return $hotel['nombre'];
            }

            return null;
        } catch (PDOException $e) {

            return null;
        }
    }

    /**
     * Obtiene el nombre de una habitación por su ID desde el modelo de habitaciones.
     *
     * @param int $idHabitacion El ID de la habitación del cual obtener el nombre.
     * @return string|null Retorna el nombre de la habitación si existe; null si no existe o hay un error.
     */
    public function obtenerNombreHabitacionPorId($idHabitacion)
    {
        try {
            $habitacion = $this->hotelesModel->getHabitacionPorId($idHabitacion);

            if ($habitacion) {
                return $habitacion['tipo'];
            }

            return null;
        } catch (PDOException $e) {
            // Manejar cualquier excepción de PDO aquí, si es necesario
            return null;
        }
    }
}
