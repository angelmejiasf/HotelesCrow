<?php


/**
 * Function para mostrar el formulario de inicio de sesion 
 * 
 * 
 */
function mostrarFormularioInicioSesion()
{
    echo "<div class='iniciosesion'>";
    echo '<h1>Iniciar Sesión</h1>';
    echo '<form action="index.php" method="post">';
    echo '<label for="nombreUsuario">Nombre de Usuario:</label>';
    echo '<input type="text" id="nombreUsuario" name="nombreUsuario">';
    echo '<label for="contrasena">Contraseña:</label>';
    echo '<input type="password" id="contrasena" name="contrasena">';
    echo '<input type="submit" name="submit_login" value="Iniciar Sesión">';
    echo '</form>';
    echo "</div>";
}
