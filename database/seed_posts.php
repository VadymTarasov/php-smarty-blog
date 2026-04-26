<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$pdo = Database::getInstance();

$categories = $pdo->query("SELECT id FROM categories")->fetchAll(PDO::FETCH_COLUMN);

if (empty($categories)) {
    die("No categories found.");
}

$images = [
    "https://images.unsplash.com/photo-1518770660439-4636190af475",
    "https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5",
    "https://images.unsplash.com/photo-1555066931-4365d14bab8c",
    "https://images.unsplash.com/photo-1498050108023-c5249f4df085",
    "https://images.unsplash.com/photo-1551288049-bebda4e38f71",
];

$stmtPost = $pdo->prepare("
    INSERT INTO posts (title, description, content, image, views)
    VALUES (?, ?, ?, ?, ?)
");

$stmtRel = $pdo->prepare("
    INSERT INTO post_categories (post_id, category_id)
    VALUES (?, ?)
");

for ($i = 1; $i <= 10; $i++) {

    $title = "Post $i";
    $description = "Description of post $i";
    $content = "Full content for post $i";
    $image = $images[array_rand($images)];
    $views = rand(1, 100);

    $stmtPost->execute([
        $title,
        $description,
        $content,
        $image,
        $views
    ]);

    $postId = $pdo->lastInsertId();
    $randomCategory = $categories[array_rand($categories)];

    $stmtRel->execute([
        $postId,
        $randomCategory
    ]);
}