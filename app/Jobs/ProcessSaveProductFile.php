<?php

namespace App\Jobs;

use App\Contracts\AddProductInterface;
use App\Contracts\ProductInterface;
use App\Models\Product;
use App\Services\AddProductService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessSaveProductFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(){}

    /**
     * Execute the job.
     */
    public function handle(AddProductInterface $addProductInterface): void
    {
        ini_set('memory_limit','540M');
        set_time_limit(1070);

        $addProductInterface->addProducts(); 
    }
}
