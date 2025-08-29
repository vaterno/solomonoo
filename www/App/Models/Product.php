<?php

namespace App\Models;

use Lib\Model;
use Lib\Traits\HasCreatedAt;
use Lib\Traits\HasShortDescription;

class Product extends Model
{
    use HasCreatedAt;
    use HasShortDescription;

    public function __construct(
        public string $title,
        string $short_description,
        public int|string|null $id = null,
        public float $price = 0.0,
        public ?int $category_id = null,
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

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $categoryId = null): static
    {
        $this->category_id = $categoryId;

        return $this;
    }
}