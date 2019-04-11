<!-- history.blade.php -->
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
        <th>Tình trạng</th>
      </tr>
    </thead>
    <tbody>
      @foreach($result as $room)
      <tr>
        <td>{{$room->roomname}}</td>
        <td>{{$room->shift}}</td>
        <td>{{$room->date}}</td>
        <td>{{$room->seats}}</td>
        @if(is_null($room->status))
            <td>Đang chờ</td>
            <td>
                <form method="POST" action="{{ action('RoomSessionController@removeSubscribe', $room->id)}}">
                {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="submit" class="btn btn-warning" value="Hủy">
                </form>
            </td>
        @elseif($room->status == 1)
            <td>Thành công</td>
            <td>
                <form method="POST" action="{{ action('RoomSessionController@removeSubscribe', $room->id)}}">
                {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="submit" class="btn btn-danger" value="Hủy">
                </form>
            </td>
        @else
            <td>Bị hủy</td>
            <td></td>
        @endif
        
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection