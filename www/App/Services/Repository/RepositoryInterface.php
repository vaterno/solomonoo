<?php

namespace App\Services\Repository;

use Lib\Model;
use Lib\QueryParams;

interface RepositoryInterface
{
    public static function findAll(): array;
    public static function findBy(QueryParams $queryParams): array|Model|null;
    public static function findById(int $entityId): Model|null;

}