<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$pdo = Database::getInstance();
$categories = [];

for ($i = 1; $i <= 5; $i++) {
    $categories[] = [
        'name' => "category $i",
        'description' => "description $i"
    ];
}

$stmt = $pdo->prepare("
    INSERT INTO categories (name, description)
    VALUES (?, ?)
");

foreach ($categories as $cat) {
    $stmt->execute([
        $cat['name'],
        $cat['description']
    ]);
}