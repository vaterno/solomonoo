<?php

namespace App\Controllers;

use Lib\AbstractController;
use App\Helpers\ProductSortHelpers;
use App\Services\Repository\CategoryRepository;

class IndexController extends AbstractController
{
    public function index()
    {
        $categories = CategoryRepository::findAllWithProductCount();
        $productSortHelpers = ProductSortHelpers::getSorts();

        $this->view->categories = $categories;
        $this->view->productSortHelpers = $productSortHelpers;

        echo $this->view->render('index');
    }
}
