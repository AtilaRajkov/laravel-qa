<div class="row mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h3>Your Answer</h3>
        </div>
        <hr>

        <form action="{{route('questions.answers.store', $question->id)}}"
              method="post">
          @csrf
          <div class="form-group">
            <textarea class="form-control
                      {{$errors->has('body') ? 'is-invalid' : '' }}"
                      name="body"
                      id="answer-body"
                      cols="30" rows="7"
            >{{old('body')}}</textarea>
            @error('body')
              <p class="text-danger">
                <strong>{{$message}}</strong>
              </p>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit"
                    class="btn btn-lg btn-outline-primary">
              Submit
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>