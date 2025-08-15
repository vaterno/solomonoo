<?php

namespace App\Helpers;

class ProductSortHelpers
{
    public static function getSorts()
    {
        return [
            'lowest' => [
                'id' => 'lowest',
                'description' => 'Lowest',
                'field' => 'price',
                'sort' => 'ASC',
            ],
            'alphabetically' => [
                'id' => 'alphabetically',
                'description' => 'Alphabetically',
                'field' => 'title',
                'sort' => 'ASC',
            ],
            'newest' => [
                'id' => 'newest',
                'description' => 'The newest',
                'field' => 'created_at',
                'sort' => 'DESC',
            ],
        ];
    }
}
