<?php

namespace App\Helpers;

class ProductHelper
{
    public static function getBindedCategoriesToProducts(array $products, array $categories): array
    {
        if (empty($products) || empty($categories)) {
            return $products;
        }

        $categories = ArrayHelpers::indexBy($categories, 'id');

        return array_reduce($products, function ($carry, $product) use($categories) {
            $product = (array)$product;
            $product['category'] = null;

            if (
                !empty($product['category_id']) &&
                !empty($categories[$product['category_id']])
            ) {
                $product['category'] = (array)$categories[$product['category_id']];
            }

            $carry[] = $product;
            return $carry;
        }, []);
    }
}
