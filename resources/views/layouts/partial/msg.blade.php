
@if(isset($errors)&& count($errors) > 0)
                @foreach($errors->all() as $error)
                  <div class="alert  alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        <li><strong>{!! $error !!}</strong></li>
                    </strong>
                  </div>
                @endforeach
              @endif


@if(session()->has('success'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>
                    {!! session()->get('success') !!}
                  </strong>
                </div>
             @endif