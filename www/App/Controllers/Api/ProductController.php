<?php

namespace App\Controllers\Api;

use App\Helpers\ProductHelper;
use App\Models\Product;
use App\Models\Category;
use Lib\AbstractController;
use App\Services\Repository\ProductRepository;
use App\Services\Repository\CategoryRepository;

class ProductController extends AbstractController
{
    public function index()
    {
        $queryParams = $this->getQueryParams(
            $this->request->getGetData()
        );

        /** @var Product[] $products */
        $products = ProductRepository::findBy($queryParams);

        if (!empty($products)) {
            /** @var Category[] $categories */
            $categories = CategoryRepository::findAll();

            if (!empty($categories)) {
                /** @var array $products */
                $products = ProductHelper::getBindedCategoriesToProducts($products, $categories);
            }
        }

        echo json_encode([
            'products' => $products,
        ]);
        die;
    }

    public function show()
    {
        $result = [
            'success' => true,
            'message' => null,
            'productData' => null
        ];

        try {
            $productId = $this->request->id;

            if (!empty($productId)) {
                $result['productData'] = ProductRepository::findById(
                    (int)$productId
                );

                if (empty($result['productData'])) {
                    $result['success'] = false;
                    $result['message'] = 'Product not found';
                }
            } else {
                throw new \Exception('Product id not provided');
            }
        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
        die;
    }
}
