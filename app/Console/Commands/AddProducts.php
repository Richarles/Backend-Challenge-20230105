<?php

namespace App\Console\Commands;

use App\Jobs\ProcessSaveProductFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add products from external api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ProcessSaveProductFile::dispatch();
    }
}