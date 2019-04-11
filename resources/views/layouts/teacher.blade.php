@extends('layouts.app')
@section('menu')
  <li><a href="{{ url('/booking') }}">Đặt phòng</a></li>
  <li><a href="{{ url('/booking/history') }}">Lịch sử</a></li>
@endsection