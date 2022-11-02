<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'next_date' => 'array',
    ];

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class)->withDefault();
    }
}
