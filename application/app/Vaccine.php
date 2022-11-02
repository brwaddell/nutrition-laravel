<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function immunization(){
        return $this->hasMany(Immunization::class);
    }
}
