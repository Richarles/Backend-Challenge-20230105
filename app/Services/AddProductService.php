<?php

namespace App\Services;

use App\Contracts\AddProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class AddProductService implements AddProductInterface
{
    public function getDataFile(){
        $collection = collect([1,2,3,4,5,6,7,8,9]);
 
        $multiplied = $collection->map(function (int $item, int $key) {
            $handle = gzopen("https://challenges.coode.sh/food/data/json/products_0".$item.".json.gz", "r");
            $contents = gzread($handle, 649990);
            
            return $contents ;
        });

        $this->log();

        return $multiplied->all();
    }

    public function addProducts(){
        $files = $this->getDataFile();

        foreach ($files as $key => $files) {
            $divideDataFile = explode("\n",$files,101);
            $lenghtArray = array_slice($divideDataFile, 0, 100);
            
            foreach ($lenghtArray as $key => $dataFile) {
                $decodeJson = json_decode($dataFile,true);
                $dataProduct = str_replace('"', "", $decodeJson);

                Product::firstOrCreate(['code' =>  $dataProduct['code']],$this->dataCreateProduct($dataProduct));
            }
        }
    }

    public function log(){
        $logSchedule = Log::build([
            'driver' => 'single',
            'path' => storage_path('app/public/logs/schedule.log'),
        ]);

        return $logSchedule->info('Uso de memória :'.convertByts(memory_get_usage(),'MB'));
    }

    public function dataCreateProduct($dataProduct)
    {
        $data = [
            'code' => $dataProduct['code'] ?? 0,
            'status' => \App\Enum\ProductStatusEnum::DRAFT,
            'imported_t' => \Carbon\Carbon::now()->addMinutes(),
            'url' => $dataProduct['url'] ?? null,
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