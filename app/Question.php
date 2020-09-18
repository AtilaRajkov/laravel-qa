<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Question extends Model
{
  use SoftDeletes, VotableTrait;

  protected $fillable = ['title', 'body', 'user_id'];


  public function user()
  {
    return $this->belongsTo(User::class);
  }



//  public function setTitleAttribute($value)
//  {
//    $this->attributes['title'] = $value;
//    $this->attributes['slug'] = Str::slug($value);
//  }


  public function setBodyAttribute($value)
  {
    $this->attributes['body'] = clean($value);
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
    return clean($this->body);
  }


  public function answers()
  {
    return $this->hasMany(Answer::class);
  }


  public function acceptBestAnswer(Answer $answer)
  {
    if ($this->best_answer_id === $answer->id) {
      $this->best_answer_id = null;
    } else {
      $this->best_answer_id = $answer->id;
    }

    $this->save();
  }


  public function favorites()
  {
    return $this->belongsToMany(User::class, 'favorites')
      ->withTimestamps(); // , 'question_id', ''user_id);
  }


  public function isFavorited()
  {
    return $this->favorites()->where('user_id', auth()->id())->count() > 0;
  }


  public function getIsFavoritedAttribute()
  {
    return $this->isFavorited();
  }


  public function getFavoritesCountAttribute()
  {
    return $this->favorites->count();
  }


  public function getExcerptAttribute()
  {
    //return Str::limit(strip_tags($this->bodyHtml()),300);
    return $this->excerpt(250);
  }


  public function excerpt($length)
  {
    return Str::limit($this->body_html, $length);
  }


  // Unused method
  private function bodyHtml()
  {
    // return \Parsedown::instance()->text($this->body);
  }


  // atila
  public function getAnswersPaginatedAttribute()
  {
    return $this->answers()
//      ->latest()
      ->paginate(4);
  }

  /// atila
  public function toggleFavorite()
  {
    if (
    $this->favorites()->where('user_id', auth()->id())->exists()
    ) {
      // Already favorited by this user
      $this->favorites()->detach(auth()->id());
    } else {
      // Not favorited yet
      $this->favorites()->attach(auth()->id());
    }
  }








}
