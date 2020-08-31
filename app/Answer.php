<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

  public function question()
  {
    return $this->belongsTo(Question::class);
  }


  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public function getBodyHtmlAttribute()
  {
    // This is resolved wit {!! $answer->body !!}
  }


  public static function boot()
  {
    parent::boot();

    static::created(function($answer) {
      $answer->question->increment('answers_count');
      $answer->question->save();
    });

  } 
  
}