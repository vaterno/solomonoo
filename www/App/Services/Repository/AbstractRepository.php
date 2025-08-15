<?php

namespace App\Services\Repository;

use Lib\Db;
use Lib\Model;
use Lib\QueryParams;

abstract class AbstractRepository
{
    public const string PRIMARY_KEY = 'id';
    public const string TABLE = '';
    public const array COLUMNS = [];

    public function __construct(
        protected Model $model
    ) {
    }

    /**
     * @throws \Exception
     */
    public static function findAll(): array
    {
        $db = Db::instance();

        $sqlData = 'SELECT * FROM ' . static::TABLE . ' ORDER BY ' . static::PRIMARY_KEY . ' DESC';

        $data = $db->query($sqlData);
        $entities = static::fillEntity($data);

        return $entities;
    }

    /**
     * @throws \Exception
     */
    public static function findBy(QueryParams $queryParams): array|Model|null
    {
        $data = [];
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;

        $filters = $queryParams->getFilters();
        if (!empty($filters)) {
            $stack = [];

            foreach ($filters as $index => $filter) {
                if (!in_array($filter['field'], static::COLUMNS)) {
                    throw new \Exception('Invalid filter field: ' . $filter['field']);
                }

                $nameOfFilterValue = ':' . $filter['field'] . $index;
                $stack[] = $filter['field'] . ' ' . $filter['operator'] . ' ' . $nameOfFilterValue . ' ';

                $data[$nameOfFilterValue] = $filter['value'];
            }

            if (!empty($stack)) {
                $sql .= ' WHERE ';
                $sql .= implode(' ', $stack);
            }
        }

        $orderBy = $queryParams->getOrderBy();
        if (!empty($orderBy)) {
            $stack = [];

            foreach ($orderBy as $orderFieldName => $orderFieldDirection) {
                if (!in_array($orderFieldName, static::COLUMNS)) {
                    throw new \Exception('Invalid filter field: ' . $orderFieldName);
                }

                $stack[] = $orderFieldName . ' ' . $orderFieldDirection . ' ';
            }

            if (!empty($stack)) {
                $sql .= ' ORDER BY ';
                $sql .= implode(' ', $stack);
            }
        }

        $data = $db->query($sql, $data);
        $data = static::fillEntity($data) ?: null;

        return $data ?: null;
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
