<!-- approve.blade.php -->
@extends('layouts.admin')
@section('content')
  <div class="container">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Phòng học</th>
        <th>Ca học</th>
        <th>Ngày học</th>
        <th>Số ghế ngồi</th>
        <th>Người đăng ký</th>
      </tr>
    </thead>
    <tbody>
      @foreach($roomSubscrived as $room)
      <tr>
        <td>{{$room->roomname}}</td>
        <td>{{$room->shift}}</td>
        <td>{{$room->date}}</td>
        <td>{{$room->seats}}</td>
        <td>{{$room->user}}</td>
        <td>
          <form method="POST" action="{{ action('RoomSessionController@approve', $room->id)}}">
           {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <input type="submit" class="btn btn-primary" value="Okk">
          </form>
        </td>
        <td>
          <form method="POST" action="{{ action('RoomSessionController@nonApprove', $room->id)}}">
           {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
            <input type="submit" class="btn btn-warning" value="X">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection