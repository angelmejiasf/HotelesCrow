<?php

class Reservas_Controller
{
    private $reservasModel;

    public function __construct($reservasModel)
    {
        $this->reservasModel = $reservasModel;
    }



    /**
     * Reserva una habitación si está disponible y la fecha de entrada es válida.
     *
     * @param int $id_usuario El ID del usuario que realiza la reserva.
     * @param int $id_hotel El ID del hotel para la reserva.
     * @param int $id_habitacion El ID de la habitación a reservar.
     * @param string $fecha_entrada La fecha de entrada para la reserva.
     * @param string $fecha_salida La fecha de salida para la reserva.
     * @return void
     */
    public function reservarHabitacion($id_usuario, $id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida) {
        $mensaje = null;
    
        // Validar si la habitación está disponible para las fechas deseadas
        if ($this->habitacionDisponible($id_habitacion, $fecha_entrada, $fecha_salida)) {
            // Validar la fecha de entrada
            if ($this->fechaEntradaValida($fecha_entrada)) {
                // Validar que la fecha de salida sea posterior a la fecha de entrada
                if ($fecha_salida >= $fecha_entrada) {
                    // La fecha de salida es válida, procede con la reserva
                    $this->reservasModel->insertarReserva($id_usuario, $id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida);
                    $mensaje=new Mensaje("<h1>RESERVA REALIZADA</h1> <h2>Puedes ver tu reserva en 'Ver Reservas'</h2>");
                } else {
                    $mensaje = new Mensaje("<h1 class='error-message'>Error: La fecha de salida debe ser posterior o igual a la fecha de entrada.</h1>");
                }
            } else {
                $mensaje = new Mensaje("<h1 class='error-message'>Error: La fecha de entrada debe ser posterior al día actual.</h1>");
            }
        } else {
            $mensaje = new Mensaje("<h1 class='error-message'>Error: La habitación no está disponible para las fechas deseadas o has puesto una fecha inválida.</h1>");
        }
    
        return $mensaje;
    }

    /**
     * Verifica la disponibilidad de una habitación utilizando el modelo de reservas.
     *
     * @param int $id_habitacion El ID de la habitación a verificar.
     * @param string $fecha_entrada La fecha de entrada para la reserva.
     * @param string $fecha_salida La fecha de salida para la reserva.
     * @return bool Retorna true si la habitación está disponible; false si está ocupada.
     */
    private function habitacionDisponible($id_habitacion, $fecha_entrada, $fecha_salida)
    {

        $disponible = $this->reservasModel->habitacionDisponible($id_habitacion, $fecha_entrada, $fecha_salida);

        return $disponible;
    }

    /**
     * Verifica si la fecha de entrada es posterior o igual al día actual.
     *
     * @param string $fecha_entrada La fecha de entrada para la reserva.
     * @return bool Retorna true si la fecha de entrada es válida; false si no lo es.
     */
    private function fechaEntradaValida($fecha_entrada)
    {

        $fecha_actual = date("Y-m-d");


        return ($fecha_entrada >= $fecha_actual);
    }

    /**
     * Obtiene todas las reservas desde el modelo de reservas.
     *
     * @return array Un array con todas las reservas, cada una representada como un array asociativo.
     */
    public function obtenerReservas()
    {
        return $this->reservasModel->listarReservas();
    }
}
class Mensaje {
    protected $mensaje;

    public function __construct($mensaje) {
        $this->mensaje = $mensaje;
    }

    public function getMensaje() {
        return $this->mensaje;
    }
    
}
