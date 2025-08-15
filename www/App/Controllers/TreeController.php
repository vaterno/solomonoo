<?php

namespace App\Controllers;

use Lib\AbstractController;
use Lib\Db;

class TreeController extends AbstractController
{
    public function index()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM `categories_second`';
        $categories = $db->query($sql);

        /*
        categories_id   parent_id
        ...
        23              3
        661             23
        804             23
        ...
        */

        $tree = [];
        foreach ($categories as $category) {
            $tree[$category['categories_id']] = $tree[$category['categories_id']] ?? [];

            if (!empty($category['parent_id'])) {
                // $tree[3][23] = &$tree[23];
                // $tree[23][661] = &$tree[661];
                // $tree[23][804] = &$tree[804];
                $tree[$category['parent_id']][$category['categories_id']] = &$tree[$category['categories_id']];
            }
        }

        foreach ($tree as $categoryId => &$category) {
            if (empty($category)) {
                $category = $categoryId;
            }
        }

        dd(
            '[3][23][661] - ' . isset($tree[3][23][661]),
            '[3][24][614] - ' . isset($tree[3][24][614]),
            '[3][23][804] - ' . isset($tree[3][23][804]),
            '[3][61] - ' . isset($tree[3][61]),
            $tree
        );
    }
}
