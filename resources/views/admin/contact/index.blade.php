@extends('layouts.app')

@section('title','Contact')
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
                  <h4 class="card-title ">All Contact Message</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" style="width:100%" sellspacing="0" class="table ">
                      <thead class=" badge-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Subject</th>
                        <th>Sent At</th>
                      
                        <th>Action</th>

                      </thead>
                      <tbody id="data">
                        
                        @if(count($contacts) > 0)
                        @foreach($contacts as $key=>$contact)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->subject}}</td>
                            <td>{{$contact->created_at}}</td>
                            <td><a href="{{route('contact.show',$contact->id)}}" class="btn btn-info btn-sm"><i class="material-icons">details</i></a>
                            <form id="form-delete-{{$contact->id}}" method="POST" action="{{route('contact.destroy',$contact->id)}}"style="display: none;">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this?')){
                              event.preventDefault();
                              document.getElementById('form-delete-{{$contact->id}}').submit();
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
                    {{$contacts->render()}}
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