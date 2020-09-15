<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsController')
  ->except('show');

//Route::post('/questions/{question}/answers', 'AnswerController@store')
//  ->name('answers.store');
Route::resource('questions.answers', 'AnswersController')
  ->only('store', 'edit', 'update', 'destroy');

Route::get('/questions/{slug}', 'QuestionsController@show')
  ->name('questions.show');

// Single-action controller, doesn't need to specify the actions name
Route::post('/answers/{answer}/accept', 'AcceptAnswersController')
  ->name('answers.accept');

Route::patch('/questions/{question}/favorite', 'QuestionsController@favorite')
  ->name('questions.favorite');

Route::post('/questions/{question}/vote', 'VoteQuestionController')
  ->name('questions.vote');

