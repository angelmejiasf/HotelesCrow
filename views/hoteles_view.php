<?php
echo "<link rel='stylesheet' type='text/css' href='./css/estilo.css'>";
session_start();
require_once './models/Hotel.php';

function cerrarSesion(){
    echo "<form action='index.php' method='GET'>";
    echo "<input type='submit' name='cerrar_sesion' value='Cerrar Sesion'>";
    echo "</form>";
}
function mostrarlasreservas(){
    echo "<form action='index.php' method='GET'>";
    echo "<input type='submit' name='mostrar_reservas' value='Ver Reservas'>";
    echo "</form>";

}
/**
 * Muestra la información de un hotel y un formulario de reserva.
 *
 * @param array $hotel Un array asociativo con la información del hotel.
 * @param object $hotelesController Una instancia de la clase HotelesController.
 * @return void
 */
function mostrarHotel($hotel, $hotelesController) {
   
   
    // Crear un objeto Hotel con la información proporcionada
    $hotelObjeto = new Hotel(
        $hotel['nombre'],
        $hotel['direccion'],
        $hotel['ciudad'],
        $hotel['pais'],
        $hotel['num_habitaciones'],
        $hotel['descripcion']
    );

    // Mostrar la información del hotel utilizando el método mostrarInformacion de la clase Hotel
    $hotelObjeto->mostrarInformacion();
    mostrarFormularioReserva($hotel,$hotelesController);
}
/**
 * Muestra un formulario de reserva si la sesión del usuario está iniciada.
 *
 * @param array $hotel Un array asociativo con la información del hotel.
 * @param object $hotelesController Una instancia de la clase HotelesController.
 * @return void
 */
function mostrarFormularioReserva($hotel, $hotelesController)
{
    if (isset($_SESSION['id'])) {
        echo "<div class='reserva'>";
        echo "<h3>HAZ UNA RESERVA</h3>";
        echo "<form action='index.php' method='post'>";
        echo "<div>";
        echo "<label for='habitacion'>Seleccione una habitación:</label>";

        $habitacionesDisponibles = $hotelesController->obtenerHabitacionesDisponibles($hotel['id']);

        echo "<select name='habitacion'>";
        foreach ($habitacionesDisponibles as $habitacion) {
            echo "<option value='{$habitacion['id']}'>{$habitacion['tipo']}</option>";
        }
        echo "</select><br/>";
        echo "</div>";

        echo "<input type='hidden' name='id_usuario' value='{$_SESSION['id']}'>";
        echo "<input type='hidden' name='id_hotel' value='{$hotel['id']}'>";
        echo "<label for='fecha_entrada'>Fecha de Entrada:</label>";
        echo "<input type='date' name='fecha_entrada' required><br/>";
        echo "<label for='fecha_salida'>Fecha de Salida:</label>";
        echo "<input type='date' name='fecha_salida' required><br/>";
        echo "<input type='submit' name='submit_reserva' value='Reservar'>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "Error: Sesión de usuario no iniciada. Por favor, inicia sesión.";
    }
}



// ***PARA COMPROBAR EL ID USUARIO QUE HA INICIADO SESION***
// function mostrarIdUsuario()
// {
//     if (isset($_SESSION['id'])) {
//         $idUsuario = $_SESSION['id'];
//         echo "ID de usuario: $idUsuario";
//     } else {
//         echo "Error: Sesión de usuario no iniciada.";
//     }
// }
