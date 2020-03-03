@extends('front-end.master')
@section('content')
<br>
<form action="{{route('create_register')}}" method="POST">
    {{ csrf_field() }}
    <div class="container">
        <h1>Hồ Sơ</h1>
        <!-- <p>Please fill in this form to create an account.</p> -->
        <hr>
        <label for="fullname"><b>Họ tên chủ hộ</b></label>
        <input type="text" placeholder="" name="fullname" required>

        <label for="fullname"><b>Số tờ </b></label>
        <input type="number" placeholder="" name="number_t" required>

        <label for="fullname"><b>Số thửa</b></label>
        <input type="number" placeholder="" name="number_th" required>

        <label for="fullname"><b>Phường</b></label>
        <input type="text" placeholder="" name="ward" required>

        <label for="fullname"><b>Quận</b></label>
        <input type="text" placeholder="" name="district" required>

        <input type="hidden" id="custId" name="status" value="1">
        <button type="submit" class="registerbtn">Gửi</button>
    </div>
</form>
@endsection
