@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h1>
                Editing answer for question:
                <strong>
                  {{ $question->title }}
                </strong>
              </h1>
            </div>
            <hr>

            <form action="{{route('questions.answers.update',
                      [$question->id, $answer->id])}}"
                  method="post">
              @csrf
              @method('PATCH')
              <div class="form-group">
                <textarea class="form-control
                          {{$errors->has('body') ? 'is-invalid' : '' }}"
                          name="body"
                          id="answer-body"
                          cols="30" rows="7"
                >{{old('body', $answer->body)}}</textarea>
                @error('body')
                <p class="text-danger">
                  <strong>{{$message}}</strong>
                </p>
                @enderror
              </div>
              <div class="form-group">
                <button type="submit"
                        class="btn btn-lg btn-outline-primary">
                  Update
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>


@endsection