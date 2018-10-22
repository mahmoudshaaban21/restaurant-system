@extends('layouts.app')

@section('title','Reservation')
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
                  <h4 class="card-title ">Reservations</h4>
                </div>
                <div class="card-body">
                 
                  <div class="table-responsive">
                    <table id="table" style="width:100%" sellspacing="0" class="table ">
                      <thead class="  badge-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Time and Date</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>

                      </thead>
                      <tbody id="data">
                        @if(count($reservations) > 0)
                        @foreach($reservations as $key=>$reservation)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$reservation->name}}</td>
                            <td>{{$reservation->phone}}</td>
                            <td>{{$reservation->email}}</td>
                            <td>{{$reservation->date_and_time}}</td>
                            <th>{{$reservation->message}}</th>
                            <th>
                              @if($reservation->status == true)
                                <span class="badge badge-info">confirmed</span>
                              @else
                                <span class="badge badge-danger">not confirmed yet</span>
                              @endif
                            </th>
                            <td>{{$reservation->created_at}}</td>
                              <td>
                            @if($reservation->status == false)
                            <form id="form-delete-{{$reservation->id}}" method="POST" action="{{route('reservation.status',$reservation->id)}}"style="display: none;">
                              @csrf
                            </form>
                            <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Are you sure you verify this request?')){
                              event.preventDefault();
                              document.getElementById('form-delete-{{$reservation->id}}').submit();
                            }else{
                              event.preventDefault();
                            }">
                              <i class="material-icons">done</i>
                            </button>
                            @endif
                            <form id="form-delete-{{$reservation->id}}" method="POST" action="{{route('reservation.destroy',$reservation->id)}}"style="display: none;">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this reservation?')){
                              event.preventDefault();
                              document.getElementById('form-delete-{{$reservation->id}}').submit();
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
                    {{$reservations->render()}}
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
