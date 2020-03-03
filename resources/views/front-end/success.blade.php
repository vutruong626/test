@extends('front-end.master')
@section('content')
@foreach($query as $item)
<div class="text">
    <h4>Bạn đã gửi hồ sơ thành công</h4>
    <p>Vui lòng lưu lại mã hồ sơ của bạn <strong>MHS: {{$item->code}}</strong></p>
    <a href="/" class="previ"><button class="btn-1211">>> Danh sách hồ sơ</button></a>
    <br>
</div>

@endforeach
@endsection