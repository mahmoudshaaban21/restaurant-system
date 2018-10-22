@extends('layouts.app')

@section('title','Slider')
@push('css')


@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{route('slider.create')}}" class="btn btn-primary">Add New Item</a>
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">All Slider</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" style="width:100%" sellspacing="0" class="table ">
                      <thead class=" badge-primary">
                        <th>ID</th>
                        <th>Tilte</th>
                        <th>Sub Title</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>

                      </thead>
                      <tbody id="data">
                        @if(count($sliders) > 0)
                        @foreach($sliders as $key=>$slider)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->sub_title}}</td>
                            <td>{{$slider->image}}</td>
                            <td>{{$slider->created_at}}</td>
                            <td>{{$slider->updated_at}}</td>
                            <td><a href="{{route('slider.edit',$slider->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                            <form id="form-delete-{{$slider->id}}" method="POST" action="{{route('slider.destroy',$slider->id)}}"style="display: none;">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this?')){
                              event.preventDefault();
                              document.getElementById('form-delete-{{$slider->id}}').submit();
                            }else{
                              event.preventDefault();
                            }">
                              <i class="material-icons">delete</i>
                            </button>


                            </td>

                          </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                    {{$sliders->render()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')


</script>
@endpush