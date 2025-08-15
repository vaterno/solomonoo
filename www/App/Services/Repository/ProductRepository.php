<?php

namespace App\Services\Repository;

use App\Models\Product;

class ProductRepository extends AbstractRepository
{
    public const string TABLE = 'products';
    public const array COLUMNS = [
        'title',
        'short_description',
        'id',
        'price',
        'category_id',
        'created_at',
    ];

    public static function getModelClass(): string
    {
        return Product::class;
    }
}
