<?php

namespace App\Http\Controllers;

use App\Contracts\AddProductInterface;
use App\Contracts\ListProductInterface;
use App\Contracts\ShowProductInterface;
use App\Contracts\UpdateProductInterface;
use App\Jobs\ProcessSaveProductFile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function __construct(
        public Product $product,
        public AddProductInterface $addProductInterface,
        public ListProductInterface $listProductInterface,
        public ShowProductInterface $showProductInterface,
        public UpdateProductInterface $updateProductInterface,
        public ProcessSaveProductFile $processSaveProductFile,
    ) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infoApi = $this->listProductInterface->infoApi();

        return response()->json($infoApi);
    }

    public function listProduct (Request $request)
    {
        $listProduct = $this->listProductInterface->listProduct($request);

        return response()->json($listProduct);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($code)
    {
        $showProduct = $this->showProductInterface->showProduct($code);
        
        return response()->json($showProduct);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($code)
    {
        $this->updateProductInterface->updateProducts($code);

        return response()->json('Alterado com sucesso');
    }

    public function updateData($product)
    {
        $this->updateProductInterface->updateDataProduct($product);
        
        return response()->json('Status alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
