@extends('layouts.app')

@section('title','Categories')
@push('css')

@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{route('category.create')}}" class="btn btn-primary">Add New Category</a>
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">All Categories</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" style="width:100%" sellspacing="0" class="table ">
                      <thead class=" badge-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>

                      </thead>
                      <tbody id="data">
                        @if(count($categories) > 0)
                        @foreach($categories as $key=>$category)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>{{$category->updated_at}}</td>
                            <td><a href="{{route('category.edit',$category->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                            <form id="form-delete-{{$category->id}}" method="POST" action="{{route('category.destroy',$category->id)}}"style="display: none;">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this?')){
                              event.preventDefault();
                              document.getElementById('form-delete-{{$category->id}}').submit();
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
                    {{$categories->render()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')

@endpush