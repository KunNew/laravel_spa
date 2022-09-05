<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockItem extends Model
{
    use HasFactory;

    public function setAvatarAttribute($value)
    {
        if (isset($value))
        {
            // remove old avatar on update
            if ($this->avatar) Storage::disk('public')->delete($this->avatar);
            $path = $value->store('patient/'.date('FY'), ['disk' => 'public']);
            $this->attributes['avatar'] = $path;
        }
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($item) {
            if ($item->avatar) Storage::disk('public')->delete($item->avatar);
        });
    }
}
