<?php
require_once 'config.php';

function connectDB() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function addItem($name, $price, $category, $email) {
    $pdo = connectDB();
    $sql = "INSERT INTO items (name, price, category, email, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$name, $price, $category, $email]);
}

function getItems($sortBy = 'created_at', $sortOrder = 'DESC') {
    $pdo = connectDB();
    $allowedColumns = ['name', 'price', 'category', 'created_at'];
    $sortBy = in_array($sortBy, $allowedColumns) ? $sortBy : 'created_at';
    $sortOrder = $sortOrder === 'ASC' ? 'ASC' : 'DESC';
    
    $sql = "SELECT * FROM items ORDER BY $sortBy $sortOrder";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>