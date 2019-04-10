<!-- index.blade.php -->
@extends('layouts.app')
@section('content')
  <div class="container">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Phòng học</th>
        <th>Ca học</th>
        <th>Ngày học</th>
        <th>Số ghế ngồi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($roomsessions as $room)
      <tr>
        <td>{{$room->roomname}}</td>
        <td>{{$room->shift}}</td>
        <td>{{$room->date}}</td>
        <td>{{$room->seats}}</td>
        <td>
          <form method="POST" action="{{ action('RoomSessionController@subscribe', $room->id)}}">
           {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <input type="submit" class="btn btn-primary" value="Dang ky">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection