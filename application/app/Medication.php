<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function drug() 
    {
        return $this->belongsTo(Inventory::class, 'drug_id')->withDefault();
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->withDefault();
    }
}
