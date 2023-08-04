<?php

namespace App\Services;

use App\Contracts\UpdateProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class UpdateProductService implements UpdateProductInterface
{
    public function updateDataProduct($dataCode)
    {
        $showProduct = Product::where('code',$dataCode)->first();
        $updateStatus = $showProduct->update(['status' => \App\Enum\ProductStatusEnum::TRASH]);

        return $updateStatus;
    }

    public function updateProducts ($code)
    {
        $response = Http::timeout(60)->get('https://world.openfoodfacts.org/api/v0/product/'.$code.'.json');

        $data = $response->json();
    
        $id = Product::where('code',$code)->value('id');

        return Product::find($id)->update($this->dataUpdateProduct($data['product'],$code));
    }

    public function dataUpdateProduct($dataProduct,$codeProduct)
    {
        $data = [
            'code' => $codeProduct ?? 0,
            'status' => 'draft',
            //'imported_t' => date("Y/m/d"),
            //'url' => $dataProduct['url'] ?? null,
            'creator' => $dataProduct['creator'] ?? null,
            'created_t' => $dataProduct['created_t'] ?? null,
            'last_modified_t' => $dataProduct['last_modified_t'] ?? null,
            'product_name' => $dataProduct['product_name'] ?? null,
            'quantity' => $dataProduct['quantity'] ?? null,
            'brands' => $dataProduct['brands'] ?? null,
            'categories' => $dataProduct['categories'] ?? null,
            'labels' => $dataProduct['labels'] ?? null,
            'cities' => $dataProduct['cities'] ?? null,
            'purchase_places' => $dataProduct['purchase_places'] ?? null,
            'stores' => $dataProduct['stores'] ?? null,
            'ingredients_text' => $dataProduct['ingredients_text'] ?? null,
            'traces' => $dataProduct['traces'] ?? null,
            'serving_size' => $dataProduct['serving_size'] ?? null,
            'serving_quantity' => $dataProduct['serving_quantity'] ?? '',
            'nutriscore_score' => $dataProduct['nutriscore_score'] ?? " ",
            'nutriscore_grade' => $dataProduct['nutriscore_grade'] ?? null,
            'main_category' => $dataProduct['main_category'] ?? null,
            'image_url' => $dataProduct['image_url'] ?? null
        ];
        
        return $data;
    }
}