<?php

namespace App\Models;

use Lib\Model;
use Lib\Traits\HasCreatedAt;
use App\Traits\HasShortDescription;

class Category extends Model
{
    use HasCreatedAt;
    use HasShortDescription;

    public function __construct(
        public string $title,
        string $short_description,
        public int|string|null $id = null,
        string $created_at = '',
    ) {
        $this->created_at = $created_at ?? '';
        $this->short_description = $short_description;

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
}