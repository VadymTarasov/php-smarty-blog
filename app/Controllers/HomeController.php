<?php

namespace App\Controllers;

use App\Repositories\CategoryRepository;
use Smarty\Smarty;

class HomeController
{
    public function index(): void
    {
        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getCategoriesWithPosts();
        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'category' => $category,
                'posts' => $categoryRepo->getLastPostsByCategory($category['id'])
            ];
        }

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../resources/views/');
        $smarty->assign('data', $data);
        $smarty->display('home/index.tpl');
    }
}