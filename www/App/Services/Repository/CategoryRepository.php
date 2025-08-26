<?php

namespace App\Services\Repository;

use Lib\Db;
use App\Models\Category;
use App\Helpers\ArrayHelpers;

class CategoryRepository extends AbstractSqlRepository
{
    public const string TABLE = 'categories';
    public const array COLUMNS = [
        'title',
        'short_description',
        'id',
        'created_at',
    ];

    public static function getModelClass(): string
    {
        return Category::class;
    }

    /**
     * @deprecated Move method realization to more abstract SQL layer.
     *
     * @throws \Exception
     */
    public static function findAllWithProductCount(): array
    {
        $db = Db::instance();

        $sqlData = 'SELECT c.id, c.title, c.short_description, c.created_at, COUNT(p.id) AS product_count 
                        FROM `' . static::TABLE . '` AS `c`
                        LEFT JOIN `' . ProductRepository::TABLE . '` AS p ON c.id = p.category_id 
                        GROUP BY c.id, c.title, c.short_description, c.created_at
                        ORDER BY c.id';

        $categories = $db->query($sqlData);

        if (!empty($categories)) {
            $categories = ArrayHelpers::deletNumericKeys($categories);
            $categories = ArrayHelpers::replaceKeysBy($categories, 'id');
        }

        return $categories ?: [];
    }
}
