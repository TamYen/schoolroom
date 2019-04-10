@extends('layouts.app')

@section('content')
@php ($day = isset($_GET['day']) ? $_GET['day'] : "")
@php (
      $shift = isset($_GET['shift'] ) ? $_GET['shift'] : ""
      )
<div class="container">
  <form>
    <div class="row">
    {{csrf_field()}}
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
      <div class="col-sm-10">
        <select name="shift" id="shift">
            @foreach($shifts as $ca)
                <option value="{{$ca['id']}}" <?php if( $ca['id'] == $shift) echo "selected"; else echo ""?> > {{$ca['id']}}</option>
                
            @endforeach
        </select>
        
            <input type="date" name="day" min="{{$now}}" value="{{$day}}"><br><br>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>


@if(isset($roomAvailable))
<table class="table table-striped">
    <thead>
      <tr>
        <th>Mã phòng</th>
        <th>Tên Phòng </th>
        <th>Số ghế ngồi</th>
        <th>Ca</th>
        <th>Ngày</th>
      </tr>
    </thead>
    <tbody>
      @foreach($roomAvailable as $room)
        <tr>
          <td>{{$room->id}}</td>
          <td>{{$room->name}}</td>
          <td>{{$room->seats}}</td>
          <td>{{$shift}}</td>
          <td>{{$day}}</td>
          <td>
            <form method="POST" action="{{route('booking.store')}}">
              {{csrf_field()}}
              <input type="hidden" name="room" value="{{$room->id}}">
              <input type="hidden" name="shift" value={{$shift}}>
              <input type="hidden" name="date" value={{$day}}>
              <input type="submit" class="btn btn-danger" value="Thêm">
            </form>
          </td>
        </tr>
     
      @endforeach
    </tbody>
  </table>
@endif


@endsection