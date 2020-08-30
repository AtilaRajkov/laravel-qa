<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskQuestionRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $rules = [
      'title' => 'required|string|min:3|max:255|unique:questions',
      'body' => 'required|string'
    ];

    if (in_array($this->method(), ['PUT', 'PATCH'])) {
      $question = $this->route()->parameter('question');
      $rules['title'] =
        'required|string|min:3|max:255|unique:questions,title,'.$question->id;
    }

    return $rules;
  }
}
