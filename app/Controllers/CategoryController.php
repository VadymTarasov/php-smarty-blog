<?php

namespace App\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use Smarty\Smarty;

class CategoryController
{
    public function index()
    {
        $categoryId = (int)($_GET['id'] ?? 0);
        $sort = $_GET['sort'] ?? 'date';
        $page = (int)($_GET['page'] ?? 1);

        $categoryRepo = new CategoryRepository();
        $postRepo = new PostRepository();
        $category = $categoryRepo->getById($categoryId);

        if (!$category) {
            die("Category not found");
        }

        $limit = 5;
        $posts = $postRepo->getByCategory($categoryId, $sort, $page, $limit);
        $total = $postRepo->countByCategory($categoryId);
        $totalPages = ceil($total / $limit);

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../resources/views/');
        $smarty->setCompileDir(__DIR__ . '/../../tmp/compile');
        $smarty->assign('category', $category);
        $smarty->assign('posts', $posts);
        $smarty->assign('sort', $sort);
        $smarty->assign('page', $page);
        $smarty->assign('totalPages', $totalPages);

        $smarty->display('category/index.tpl');
    }
}