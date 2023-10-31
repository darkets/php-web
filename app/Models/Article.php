<?php

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private int $id;
    private string $title;
    private string $description;
    private string $pictureUrl;
    private Carbon $timePosted;

    public function __construct(int $id, string $title, string $description, string $pictureUrl, Carbon $timePosted)
    {
        $this->title = $title;
        $this->description = $description;
        $this->pictureUrl = $pictureUrl;
        $this->timePosted = $timePosted;
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPictureUrl(): string
    {
        return $this->pictureUrl;
    }

    public function getTimePosted(): Carbon
    {
        return $this->timePosted;
    }
}