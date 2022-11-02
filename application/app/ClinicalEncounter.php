<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalEncounter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function medical_problems()
    {
        return $this->hasMany(Code::class, 'encounter_id');
    }
    public function medications()
    {
        return $this->hasMany(Medication::class, 'encounter_id');
    }
    public function suppliments()
    {
        return $this->hasMany(SupplimentOrder::class, 'encounter_id');
    }
}
