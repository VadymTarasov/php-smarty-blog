<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class PostRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getByCategory(
        int $categoryId,
        string $sort = 'date',
        int $page = 1,
        int $limit = 5
    ): array
    {
        $offset = ($page - 1) * $limit;
        $orderBy = match ($sort) {
            'views' => 'p.views DESC',
            default => 'p.created_at DESC',
        };

        $sql = "
        SELECT p.*
        FROM posts p
        INNER JOIN post_categories pc ON p.id = pc.post_id
        WHERE pc.category_id = :category_id
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByCategory(int $categoryId): int
    {
        $sql = "
        SELECT COUNT(*) 
        FROM posts p
        INNER JOIN post_categories pc ON p.id = pc.post_id
        WHERE pc.category_id = :category_id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['category_id' => $categoryId]);

        return (int)$stmt->fetchColumn();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("
        SELECT * FROM posts WHERE id = :id
        ");

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function incrementViews(int $id): void
    {
        $stmt = $this->db->prepare("
        UPDATE posts SET views = views + 1 WHERE id = :id
        ");

        $stmt->execute(['id' => $id]);
    }

    public function getRelatedPosts(int $postId, int $limit = 3): array
    {
        $sql = "
        SELECT p.*
        FROM posts p
        INNER JOIN post_categories pc ON p.id = pc.post_id
        WHERE pc.category_id IN (
            SELECT category_id
            FROM post_categories
            WHERE post_id = :post_id
        )
        AND p.id != :post_id
        GROUP BY p.id
        ORDER BY p.created_at DESC
        LIMIT $limit
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['post_id' => $postId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}