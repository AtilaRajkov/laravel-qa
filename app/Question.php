<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
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
    return route('questions.show', $this->id);
  }

  public function getCreatedDateAttribute()
  {
    return $this->created_at->diffForHumans();
    //return Carbon::parse($this->created_at)->format('d.m.Y.');
  }
}
