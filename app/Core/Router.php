<?php

namespace App\Core;

use App\Controllers\HomeController;
use App\Controllers\CategoryController;
use App\Controllers\PostController;

class Router
{
    public function run(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        match ($uri) {
            '/', '/index.php' => (new HomeController())->index(),
            '/category' => (new CategoryController())->index(),
            '/post' => (new PostController())->show(),
            default => $this->notFound(),
        };
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo "404 Not Found";
    }
}