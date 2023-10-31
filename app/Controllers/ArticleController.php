<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Collections\ArticleCollection;
use App\Response;

class ArticleController
{
    private ArticleCollection $articleCollection;

    public function __construct()
    {
        $this->articleCollection = new ArticleCollection();
    }

    public function index(): Response
    {
        return new Response('articles', [
            'articles' => $this->articleCollection->get(),
        ]);
    }

    public function show(array $args): Response
    {
        $article = $this->articleCollection->getArticleById((int)$args['id']);

        $statusCode = $article ? 200 : 404;

        return new Response('article.show', [
            'status' => $statusCode,
            'article' => $article,
        ]);
    }
}