<?php

namespace App\Contracts;

interface ListProductInterface
{
    public function infoApi();
    public function listProduct($data);
}