<?php

namespace App\Models;

use Lib\Model;
use Lib\Traits\HasCreatedAt;

class Category extends Model
{
    use HasCreatedAt;

    public function __construct(
        public string $title,
        public string $short_description,
        public int|string|null $id = null,
        string $created_at = '',
    ) {
        $this->created_at = $created_at ?? '';
        $this->initializeCreatedAt();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->short_description = $shortDescription;

        return $this;
    }
}