<?php

namespace App\Contracts;

interface UpdateProductInterface
{
    public function updateDataProduct($code);
    public function updateProducts($data);
}