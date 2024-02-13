<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles Crow</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>

    <div class="container">
        <header class="header">
            <h1>Bienvenidos a Hoteles Crow</h1>
            <img src="./assets/images/logo.png" alt="logo">
        </header>
        <?php

        require_once './db/db.php';
        require_once './views/usuarios_view.php';
        require_once './models/usuarios_model.php';
        require_once './controllers/usuarios_controller.php';
        require_once './models/hoteles_model.php';
        require_once './controllers/hotel_controller.php';
        require_once './views/hoteles_view.php';
        require_once './controllers/reservas_controller.php';
        require_once './models/reservas_model.php';
        require_once './views/reservas_view.php';

        require_once './models/Hotel.php';







        try {
            $db = new DB();
            $pdo = $db->getPDO();

            $usuariosModel = new Usuarios_Model($pdo);
            $usuariosController = new Usuarios_Controller($usuariosModel);

            $hotelesModel = new Hoteles_Model($db);
            $hotelesController = new Hotel_Controller($hotelesModel);

            $reservasModel = new Reservas_Model($pdo);
            $reservasController = new Reservas_Controller($reservasModel);

            $reservas = $reservasController->obtenerReservas();


            if (isset($_GET['mostrar_hoteles'])) {
                $hoteles = $hotelesController->listarHoteles();
            }
            if (isset($_GET['mostrar_reservas'])) {
                mostrarReservas($reservas, $usuariosController, $hotelesController);
            }

            if (isset($_GET['cerrar_sesion'])) {
                session_destroy();
                header("Location: index.php");
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_login'])) {
                $nombreUsuario = $_POST['nombreUsuario'];
                $contrasena = $_POST['contrasena'];

                if ($usuariosController->login($nombreUsuario, $contrasena)) {
                    $_SESSION['id'] = $usuariosController->obtenerIdUsuarioPorNombre($nombreUsuario);
                } else {
                    echo "<h3 class='error-message'>Inicio de sesión fallido.</h3>";
                }
            } elseif (isset($_POST['submit_reserva'])) {
                // Procesa los datos del formulario de reserva
                $id_usuario = $_POST['id_usuario'];
                $id_hotel = $_POST['id_hotel'];
                $id_habitacion = $_POST['habitacion'];
                $fecha_entrada = $_POST['fecha_entrada'];
                $fecha_salida = $_POST['fecha_salida'];


                // Intenta reservar la habitación y obtiene un mensaje de error si hay alguno
                $mensajeError = $reservasController->reservarHabitacion($id_usuario, $id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida);

                // Verifica si hay un mensaje de error y lo muestra
                if ($mensajeError !== null) {
                    echo "<h3 class='error-message'>" . $mensajeError->getMensaje() . "</h3>";
                } else {
                }


                echo "<div class='hoteles'>";

                $hoteles = $hotelesController->listarHoteles();
                mostrarlasreservas();

                if ($hoteles) {
                    foreach ($hoteles as $hotel) {
                        mostrarHotel($hotel, $hotelesController);
                    }
                } else {
                    echo "<p>No hay hoteles disponibles.</p>";
                }


                exit();
            }
        } catch (RuntimeException $e) {
            echo "<p>Error: </p>";

            mostrarFormularioInicioSesion();
            exit();
        }

        // Muestra el formulario de inicio de sesión si no hay sesión
        if (!isset($_SESSION['id'])) {

            mostrarFormularioInicioSesion();
        } else {

            echo "<div class='hoteles'>";

            $hoteles = $hotelesController->listarHoteles();
            mostrarlasreservas();
            cerrarSesion();
            if ($hoteles) {
                foreach ($hoteles as $hotel) {
                    mostrarHotel($hotel, $hotelesController);
                }
            } else {
                echo "<p>No hay hoteles disponibles.</p>";
            }
        }
        ?>
    </div>
</body>

</html>