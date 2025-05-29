<?php
try {
    $pdo = new PDO(
        "mysql:host=database;port=3306;dbname=docker",
        "docker",
        "docker"
    );
    echo "✅ เชื่อมต่อฐานข้อมูลสำเร็จ";
} catch (PDOException $e) {
    echo "❌ Error: Unable to connect to MySQL. " . $e->getMessage();
}
