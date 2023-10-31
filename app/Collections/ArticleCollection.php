<?php

namespace App\Collections;

use App\Models\Article;
use Carbon\Carbon;

class ArticleCollection
{
    private array $articles;

    public function __construct()
    {
        $this->articles = [
            new Article(
                1,
                'World News',
                'The world is still rotating!',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/2/22/Earth_Western_Hemisphere_transparent_background.png/1200px-Earth_Western_Hemisphere_transparent_background.png',
                Carbon::now()
            ),
            new Article(
                2,
                'World1 News',
                'The world is still rotating!!',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/2/22/Earth_Western_Hemisphere_transparent_background.png/1200px-Earth_Western_Hemisphere_transparent_background.png',
                Carbon::now()
            ),
            new Article(
                3,
                'World2 News',
                'The world is still rotating!!!',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/2/22/Earth_Western_Hemisphere_transparent_background.png/1200px-Earth_Western_Hemisphere_transparent_background.png',
                Carbon::now()
            )
        ];
    }

    public function getArticleById(int $id): ?Article
    {
        $articles = $this->articles;

        foreach ($articles as $article) {
            if ($article->getId() === $id) {
                return $article;
            }
        }

        return null;
    }

    public function get(): array
    {
        return $this->articles;
    }
}