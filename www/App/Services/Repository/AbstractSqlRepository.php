<?php

namespace App\Services\Repository;

use App\Helpers\ArrayHelpers;
use Lib\Db;
use Lib\Model;
use Lib\QueryParams;

abstract class AbstractSqlRepository extends AbstractRepository
{
    public const string PRIMARY_KEY = 'id';
    public const string TABLE = '';

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
}
