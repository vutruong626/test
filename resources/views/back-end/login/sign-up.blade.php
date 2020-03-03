@extends('front-end.master')
@section('content')
<div class="container-login">
    <form action="{{route('create_user')}}" method="post" style="border:1px solid #ccc">
        {{ csrf_field() }}
        <div class="container">
            <h1>Đăng ký</h1>
            <p>Vui lòng điền vào mẫu này để tạo một tài khoản.</p>
            @if ($message = Session::get('err'))
            <div class="alert alert-warning alert-index" role="alert">
                {{$message}}
            </div>
            <div class="clearfix"></div>
            @endif
            @if ($message = Session::get('success_login'))
            <div class="alert alert-warning alert-index" role="alert">
                {{$message}}
            </div>
            <div class="clearfix"></div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-warning alert-index" role="alert">
                {{$message}}
            </div>
            <div class="clearfix"></div>
            @endif
            <hr>
            <label for="fullname"><b>Họ & Tên</b></label>
            <input type="text" placeholder="Họ & Tên" name="fullname" required>

            <label for="username"><b>Tên Đăng Nhập</b></label>
            <input type="text" placeholder="Tên Đăng Nhập" name="username" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Email" name="email" required>

            <label for="email"><b>Quản lý bởi</b></label>
            <select id="country" name="country">
                <option value="1">admin</option>
                <option value="2">Trưởng phòng</option>
                <option value="3">Chuyên Viên</option>
            </select>
            <br>
            <label for="phone"><b>Số Điện Thoại</b></label>
            <input type="text" placeholder="Số Điện Thoại" name="phone" required>

            <label for="address"><b>Địa Chỉ</b></label>
            <input type="text" placeholder="Địa Chỉ" name="address" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>

            <!-- <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p> -->

            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="getBack()">Cancel</button>
                <button type="submit" class="signupbtn">Đăng ký</button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
    function getBack() {
        history.go(-1);
    }
    </script>
</div>
@endsection