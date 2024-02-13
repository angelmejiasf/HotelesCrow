<?php
echo "<link rel='stylesheet' type='text/css' href='./css/estilo.css'>";

/**
 * Función para mostrar una tabla de reservas con información de usuario y hotel.
 *
 * @param array $reservas Array de reservas que se mostrarán.
 * @param object $usuariosController Una instancia de la clase UsuariosController.
 * @param object $hotelesController Una instancia de la clase HotelesController.
 * @return void
 */

function mostrarReservas($reservas, $usuariosController, $hotelesController)
{
    if (isset($_SESSION['id'])) {
        echo "<h2>Reservas realizadas:</h2>";


        if ($reservas) {
            echo "<table class='reservas'>";
            echo "<tr>
                <th>Nombre Usuario</th>
                <th>Nombre Hotel</th>
                <th>Habitación</th>
                <th>Fecha de Entrada</th>
                <th>Fecha de Salida</th>
              </tr>";

            foreach ($reservas as $reserva) {
                $nombreUsuario = $usuariosController->obtenerNombreUsuarioPorId($reserva['id_usuario']);
                $nombreHotel = $hotelesController->obtenerNombreHotelPorId($reserva['id_hotel']);
                $nombreHabitacion = $hotelesController->obtenerNombreHabitacionPorId($reserva['id_habitacion']);
                echo "<tr>";
                echo "<td>" . $nombreUsuario . "</td>";
                echo "<td>" . $nombreHotel . "</td>";
                echo "<td>" . $nombreHabitacion . "</td>";
                echo "<td>" . $reserva['fecha_entrada'] . "</td>";
                echo "<td>" . $reserva['fecha_salida'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "<form action='index.php' method='GET'>";
            echo "<input type='submit' name='mostrar_hoteles' value='Cerrar Reservas'>";
            echo "</form>";
        } else {
            echo "<p>No hay reservas disponibles.</p>";
        }
    }
}
