<?php

namespace App\Models;

use Lib\Model;

class Product extends Model
{
    public function __construct(
        public string $title,
        public string $short_description,
        public int|string|null $id = null,
        public float $price = 0.0,
        public ?int $category_id = null,
        public string $created_at = '',
    ) {
        if (empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }
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

    public function getDescription(): string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->short_description = $shortDescription;

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

    public function getCreatedAt(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable($this->created_at));
    }

    public function setCreatedAt(string $createdAt): static
    {
        if (strtotime($createdAt) === false) {
            throw new \Exception('Was passed incorrect date');
        }

        $this->created_at = $createdAt;
        return $this;
    }
}