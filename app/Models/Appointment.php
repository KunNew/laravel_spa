<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Patient;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $casts = [
        'appoint_date' => 'datetime:d/m/Y H:i'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function setAppointDateAttribute($value)
    {
        if ($value)
        {
            $date = DateTime::createFromFormat('d/m/Y H:i', $value);
            $this->attributes['appoint_date'] = $date;
        }
    }
}
