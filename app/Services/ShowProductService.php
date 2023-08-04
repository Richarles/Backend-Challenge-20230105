<?php

namespace App\Services;

use App\Contracts\ShowProductInterface;
use App\Models\Product;

class ShowProductService implements ShowProductInterface
{
    public function showProduct($dataCode)
    {
        $showProduct = Product::where('code',$dataCode)->first();

        return $showProduct;
    }
}