<?php
class Database {
    private $connection;

    public function __construct() {
        $this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function close() {
        $this->connection->close();
    }
}
?>
