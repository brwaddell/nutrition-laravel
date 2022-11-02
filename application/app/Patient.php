<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

   protected $guarded = [];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class)->withDefault();
    }

    //public health
    public function intermittenthealth()
    {
        return $this->belongsTo(intermittenthealth::class)->where('clinic_id', session()->get('clinic_id'));
    }

    public function maternalHealth()
    {
        return $this->belongsTo(MaternalHealth::class)->where('clinic_id', session()->get('clinic_id'));
    }

    public function parentalHistory()
    {
        return $this->belongsTo(parentalHistory::class)->where('clinic_id', session()->get('clinic_id'));
    }

    public function agriculturalQuestion()
    {
        return $this->belongsTo(Agricultural::class)->where('clinic_id', session()->get('clinic_id'));
    }
    //public health end

    public function vitalSign()
    {
        return $this->hasMany(VitalSign::class)->where('clinic_id', session()->get('clinic_id'));
    }

    public function code(){
        return $this->hasMany(Code::class)->where('clinic_id', session()->get('clinic_id'));
    }

    public function checked_in()
    {
        return $this->hasOne(CheckIn::class);
    }
}
