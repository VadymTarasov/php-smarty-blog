<?php

namespace App\Controllers;

use App\Repositories\PostRepository;
use Smarty\Smarty;

class PostController
{
    public function show(): void
    {
        $postId = (int)($_GET['id'] ?? 0);
        $postRepo = new PostRepository();
        $post = $postRepo->getById($postId);

        if (!$post) {
            die("Post not found");
        }

        $postRepo->incrementViews($postId);
        $relatedPosts = $postRepo->getRelatedPosts($postId);
        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../resources/views/');
        $smarty->setCompileDir(__DIR__ . '/../../tmp/compile');
        $smarty->assign('post', $post);
        $smarty->assign('relatedPosts', $relatedPosts);

        $smarty->display('post/show.tpl');
    }
}