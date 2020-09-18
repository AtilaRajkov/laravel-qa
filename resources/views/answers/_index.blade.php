<div class="row mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h2>
            {{ $answersCount . " " .
            Str::plural('Answer', $answersCount) }}
          </h2>
        </div>
        <hr>
        @include('layouts._messages')

        @foreach($answers as $answer)
          <div class="media"
               id="answer-{{$answer->id}}-div">
            <div class="d-flex flex-column vote-controls">

            @include('shared._vote', [
              'model' => $answer,
            ])

            </div>
            <div class="media-body">
              {!! $answer->body_html !!}

              <div class="row mt-2">
                <div class="col-4">
                  <div class="ml-auto">
                    @can('update', $answer)
                      <a href="{{ route('questions.answers.edit',
                              [$question->id, $answer->id]) }}"
                         class="btn btn-sm btn-outline-info">
                        Edit
                      </a>
                    @endcan
                    @can('delete', $answer)
                      <form
                          action="{{ route('questions.answers.destroy',
                                  [$question->id, $answer->id]) }}"
                          method="post"
                          class="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                          Delete
                        </button>
                      </form>
                    @endcan
                  </div>
                </div>

                <div class="col-4"></div>

                <div class="col-4">
                  @include('shared._author', [
                    'model' => $answer,
                    'label' => 'answered',
                  ])
                </div>

              </div>


            </div>
          </div>
          <hr>
        @endforeach
      </div>
      <div class="d-flex justify-content-center">
        {{ $answers->links() }}
      </div>
    </div>
  </div>
</div>
