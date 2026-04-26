<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class CategoryRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getCategoriesWithPosts(): array
    {
        $sql = "
        SELECT DISTINCT c.*
        FROM categories c
        INNER JOIN post_categories pc ON c.id = pc.category_id
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastPostsByCategory(int $categoryId, int $limit = 3): array
    {
        $sql = "
        SELECT p.*
        FROM posts p
        INNER JOIN post_categories pc ON p.id = pc.post_id
        WHERE pc.category_id = :category_id
        ORDER BY p.created_at DESC
        LIMIT :limit
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("
        SELECT * FROM categories WHERE id = :id
        ");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}