<?php

namespace App\Services\Repository;

use Lib\Model;
use Lib\QueryParams;

abstract class AbstractRepository implements RepositoryInterface
{
    public const array COLUMNS = [];

    public function __construct(
        protected Model $model
    ) {
    }

    public static function findById(int $entityId): Model|null
    {
        $queryParams = new QueryParams();
        $queryParams->addFilter('id', '=', $entityId);

        return static::findBy($queryParams);
    }

    protected static function fillEntity(array $data = []): array|object
    {
        $result = [];

        if (!empty($data)) {
            foreach ($data as $itemData) {
                $entity = static::createEmpty();

                foreach (static::COLUMNS as $columnName) {
                    $setterMethod = str_replace('_', ' ', $columnName);
                    $setterMethod = str_replace(' ', '', ucwords($setterMethod));

                    $setterMethod = 'set' . $setterMethod;
                    $entity->$setterMethod($itemData[$columnName]);
                }

                $result[] = $entity;
            }
        }

        $result = (count($result) == 1) ? reset($result): $result;

        return $result;
    }

    private static function createEmpty(): Model
    {
        return (new \ReflectionClass(static::getModelClass()))
            ->newInstanceWithoutConstructor();
    }

    abstract public static function getModelClass(): string;
}