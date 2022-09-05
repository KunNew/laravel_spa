<?php

namespace App\Models;

use App\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockRequestItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class);
    }
}
