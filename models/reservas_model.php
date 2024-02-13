<?php
class Reservas_Model
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * Inserta una nueva reserva en la base de datos.
     *
     * @param int $id_usuario ID del usuario que realiza la reserva.
     * @param int $id_hotel ID del hotel para la reserva.
     * @param int $id_habitacion ID de la habitación reservada.
     * @param string $fecha_entrada Fecha de entrada para la reserva.
     * @param string $fecha_salida Fecha de salida para la reserva.
     * @return void
     */
    public function insertarReserva($id_usuario, $id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida)
    {
        // Realiza la inserción en la base de datos
        $query = "INSERT INTO reservas (id_usuario, id_hotel, id_habitacion, fecha_entrada, fecha_salida) 
                  VALUES (:id_usuario, :id_hotel, :id_habitacion, :fecha_entrada, :fecha_salida)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_hotel', $id_hotel, PDO::PARAM_INT);
        $stmt->bindParam(':id_habitacion', $id_habitacion, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_entrada', $fecha_entrada, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_salida', $fecha_salida, PDO::PARAM_STR);

        $stmt->execute();
    }

    /**
     * Verifica la disponibilidad de una habitación para las fechas dadas.
     *
     * @param int $id_habitacion ID de la habitación a verificar.
     * @param string $fecha_entrada Fecha de entrada para la reserva.
     * @param string $fecha_salida Fecha de salida para la reserva.
     * @return bool Retorna true si la habitación está disponible; false si está ocupada.
     */
    public function habitacionDisponible($id_habitacion, $fecha_entrada, $fecha_salida)
    {
        // Realizar la consulta para verificar la disponibilidad de la habitación
        $query = "SELECT COUNT(*) as count FROM reservas 
                  WHERE id_habitacion = :id_habitacion
                  AND (fecha_entrada <= :fecha_salida AND fecha_salida >= :fecha_entrada)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_habitacion', $id_habitacion, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_entrada', $fecha_entrada, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_salida', $fecha_salida, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result['count'] == 0);
    }

    /**
     * Obtiene todas las reservas de la base de datos.
     *
     * @return array Un array de todas las reservas, cada una representada como un array asociativo.
     */
    public function listarReservas()
    {
        $query = "SELECT * FROM reservas";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
