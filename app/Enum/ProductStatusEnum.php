<?php
namespace App\Enum;


enum ProductStatusEnum:string
{
    case DRAFT = 'draft';
    case TRASH = 'trash';
    case PUBLISHED = 'published';
}