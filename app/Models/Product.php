<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'avatar',
        'description',
        'category_id'
    ];



    public function category () {
        return $this->belongsTo(Category::class);
    }


    public function setAvatarAttribute($value)
    {
        if (isset($value)) {
            // remove old avatar on update
            if ($this->avatar) Storage::disk('public')->delete($this->avatar);
            $path = $value->store('product/' . date('FY'), ['disk' => 'public']);
            $this->attributes['avatar'] = $path;
        }
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if ($item->avatar) Storage::disk('public')->delete($item->avatar);
        });
    }
}
