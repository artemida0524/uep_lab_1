<?php
namespace App\Models;

use PDO;

require_once __DIR__ . "/../../config.php";

class DatabaseConnection {
    private static ?DatabaseConnection $instance = null;
    private PDO $connection;

    private function __construct() {
        $this->connection = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance(): DatabaseConnection {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}
?>