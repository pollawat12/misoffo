<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceMovemrntReport extends Model
{
    use HasFactory;

    protected $table = 'product_price_movemrnt_report';
    
    public $timestamps = false;
}
