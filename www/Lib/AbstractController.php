<?php

namespace Lib;

use App\Helpers\ProductSortHelpers;

abstract class AbstractController
{
    public function __construct(
        protected Request $request,
        protected $view = new View()
    ) {
    }

    protected function getQueryParams(array $queryData): QueryParams
    {
        $queryParams = new QueryParams();

        if (!empty($queryData['filters'])) {
            $filterName = array_key_first($queryData['filters']);
            $filterValue = $queryData['filters'][$filterName];

            $queryParams->addFilter($filterName, '=', $filterValue);
        }

        if (!empty($queryData['sort'])) {
            $productSortHelpers = ProductSortHelpers::getSorts();
            $sortData = $productSortHelpers[$queryData['sort']];

            $queryParams->addOrderBy($sortData['field'], $sortData['sort']);
        } else {
            $queryParams->addOrderBy('created_at');
        }

        return $queryParams;
    }
}
