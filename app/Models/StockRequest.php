<?php

namespace App\Models;

use DateTime;
use App\Models\User;
use App\Models\StockRequestItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockRequest extends Model
{
    use HasFactory;

    protected $casts = [
        'request_date' => 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y H:i:A',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stockRequestItems()
    {
        return $this->hasMany(StockRequestItem::class);
    }

    public function setRequestDateAttribute($value)
    {
        if ($value)
        {
            $date = DateTime::createFromFormat('d/m/Y', $value);
            $this->attributes['request_date'] = $date;
        }
    }
}
