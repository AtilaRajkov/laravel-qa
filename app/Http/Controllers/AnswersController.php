<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnswersController extends Controller
{

  public function __construct()
  {
    return $this->middleware('auth')
      ->only(['store']);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Question $question, Request $request)
  {
//    $request->validate([
//      'body' => 'required|string'
//    ]);
    $validator = Validator::make($request->all(), [
      'body' => 'required|string'
    ]);

    if ($validator->fails()) {
      return redirect(url()->previous() . '#answer-body')
        ->withErrors($validator)
        ->withInput();
    }

    $question->answers()
      ->create([
        'body' => $request->body,
        'user_id' => Auth::user()->id,
      ]);

    return redirect()->back()
      ->with('success', 'Your answer has been submitted successfully.');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Answer $answer
   * @return \Illuminate\Http\Response
   */
  public function edit(Answer $answer)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Answer $answer
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Answer $answer)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Answer $answer
   * @return \Illuminate\Http\Response
   */
  public function destroy(Answer $answer)
  {
    //
  }
}
