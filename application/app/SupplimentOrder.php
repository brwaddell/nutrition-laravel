<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplimentOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function suppliment() 
    {
        return $this->belongsTo(Suppliment::class)->withDefault();
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->withDefault();
    }
}
