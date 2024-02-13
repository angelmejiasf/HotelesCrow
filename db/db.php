
<?php
class DB
{
    private $pdo;

    public function __construct() {
        require_once './Config/config.php';
        
        try {
            
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            

        } catch (Exception $ex) {
            echo "<h1>La Base de Datos esta actualmente en mantenimiento</h1>";
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}


?>

