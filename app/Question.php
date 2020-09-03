<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Question extends Model
{
  use SoftDeletes;

  protected $fillable = ['title', 'body', 'user_id'];


  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }


  public function getUrlAttribute()
  {
    return route('questions.show', $this->slug);
  }


  public function getCreatedDateAttribute()
  {
    return $this->created_at->diffForHumans();
    //return Carbon::parse($this->created_at)->format('d.m.Y.');
  }


  public function getStatusAttribute()
  {
    if ($this->answers_count > 0) {
      if ($this->best_answer_id != null) {
        return "answered-accepted";
      }
      return "answered";
    }
    return "unanswered";
  }


  public function getBodyHtmlAttribute()
  {
    // This is resolved wit {!! $question->body !!}
  }


  public function answers()
  {
    return $this->hasMany(Answer::class);
  }


  public function acceptBestAnswer(Answer $answer)
  {
    $this->best_answer_id = $answer->id;
    $this->save();
  }


  public function getAnswersPaginatedAttribute()
  {
    return $this->answers()
//      ->latest()
      ->paginate(4);
  }


}
