<?php

namespace App;

use App\PublicHealthAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicHealthQuestion extends Model
{
    use HasFactory;

   protected $guarded = [];

   public function answer()
   {
       return $this->hasOne(PublicHealthAnswer::class, 'question_id', 'id');
   }
   public function answershow()
   {
       return $this->hasMany(PublicHealthAnswer::class, 'question_id', 'id');
   }

   public function form()
   {
       return $this->belongsTo(PublicHealthForm::class, 'form_id', 'id');
   }
}
