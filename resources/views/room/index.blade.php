<!-- index.blade.php -->
@extends('layouts.app')
@section('content')
  <div class="container">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Seats</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rooms as $room)
      <tr>
        <td>{{$room['id']}}</td>
        <td>{{$room['name']}}</td>
        <td>{{$room['seats']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection