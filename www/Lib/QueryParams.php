<?php

namespace Lib;

class QueryParams
{
    protected array $filters = [];
    protected array $orderBy = [];

    public function addFilter(string $field, string $operator, mixed $value): static
    {
        $allowedOperators = ['=', '!=', '<', '>', '<=', '>='];

        if (!in_array($operator, $allowedOperators)) {
            throw new \Exception("Unknown operator '{$operator}'");
        }

        $this->filters[] = [
            'field' => $field,
            'operator' => $operator,
            'value' => $value
        ];

        return $this;
    }

    public function addOrderBy(string $field, string $direction = 'DESC'): static
    {
        $direction = strtoupper($direction);
        $allowedOrder = ['ASC', 'DESC'];

        if (!in_array($direction, $allowedOrder)) {
            throw new \Exception('Invalid order direction: ' . $direction);
        }

        $this->orderBy[$field] = strtoupper($direction);

        return $this;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getOrderBy(): array
    {
        return $this->orderBy;
    }
}