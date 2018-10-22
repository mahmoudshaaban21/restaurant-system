@extends('layouts.app')

@section('title','Items')
@push('css')

@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{route('item.create')}}" class="btn btn-primary">Add New Item</a>
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">All Items</h4>
                </div>
                <div class="card-body">
                  
                  <form class="navbar-form">
                    <div class="table-responsive">
                    <table id="table" style="width:100%" sellspacing="0" class="table ">
                      <thead class=" badge-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>

                      </thead>
                      <tbody id="data">
                        @if(count($items) > 0)
                        @foreach($items as $key=>$item)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                        <img style="height: 100px;width: 100px" src="{{asset('uploads/item/'.$item->image)}}">
                            </td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td><a href="{{route('item.edit',$item->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                            <form id="form-delete-{{$item->id}}" method="POST" action="{{route('item.destroy',$item->id)}}"style="display: none;">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this?')){
                              event.preventDefault();
                              document.getElementById('form-delete-{{$item->id}}').submit();
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
                    {{$items->render()}}
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