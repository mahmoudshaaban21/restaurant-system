@extends('layouts.app')

@section('title','Create Category')
@push('css')

@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Add New Category</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Name</label>
                          <input type="text" class="form-control" name="name">
                        </div>
                      </div>
                      
                      
                      <div class="col-md-12">
                        
                        <a href="{{route('category.index')}}" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')

@endpush