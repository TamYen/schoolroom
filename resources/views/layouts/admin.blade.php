@extends('layouts.app')
@section('menu')
  <li><a href="{{ url('/booking') }}">Đặt phòng</a></li>
  <li><a href="{{ url('/booking/history') }}">Lịch sử</a></li>
  <li><a href="{{ url('/booking/create') }}">Tạo phòng</a></li>
  <li><a href="{{ url('/booking/history') }}">Duyệt đăng ký</a></li>
@endsection