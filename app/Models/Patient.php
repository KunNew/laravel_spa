<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $appends = ['name'];
    protected $casts = [
        'dob' => 'datetime:d/m/Y',
    ];

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function setDobAttribute($value)
    {
        if ($value)
        {
            $date = DateTime::createFromFormat('d/m/Y', $value);
            $this->attributes['dob'] = $date;
        }
    }

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
