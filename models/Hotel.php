<?php

class Hotel {
    protected $nombre;
    protected $direccion;
    protected $ciudad;
    protected $pais;
    protected $num_habitaciones;
    protected $descripcion;

    public function __construct($nombre, $direccion, $ciudad, $pais, $num_habitaciones, $descripcion) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->ciudad = $ciudad;
        $this->pais = $pais;
        $this->num_habitaciones = $num_habitaciones;
        $this->descripcion = $descripcion;
    }

    public function mostrarInformacion() {
        echo "<div class='hotel-card'>";
        echo "<h2>{$this->nombre}</h2>";
        echo "<p>Dirección: {$this->direccion}</p>";
        echo "<p>Ciudad: {$this->ciudad}</p>";
        echo "<p>País: {$this->pais}</p>";
        echo "<p>Número de Habitaciones: {$this->num_habitaciones}</p>";
        echo "<p>Descripción: {$this->descripcion}</p>";
        echo "</div>";
    }
}
