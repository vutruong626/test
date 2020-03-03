@extends('front-end.master')
@section('content')
<div class="container-login">
    <form action="{{route('get_admin')}}" method="post">
        {{ csrf_field() }}
        <div class="imgcontainer">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTF2-mc_vF8772-DYHCEocRWfuPTMiZdzuXUu3_WhgWRSAGLfIQ"
                alt="Avatar" class="avatar">
        </div>

        <div class="container">

            @if ($message = Session::get('status'))
            <div class="alert alert-warning alert-index" role="alert">
                {{$message}}
            </div>
            <div class="clearfix"></div>
            @endif
            <label for="username"><b>Tên Đăng Nhập</b></label>
            <input type="text" placeholder="Tên đăng nhập của ban" name="username" required>

            <label for="psw"><b>Mật Khẩu</b></label>
            <input type="password" placeholder="Mật khẩu của bạn" name="password" required>

            <button type="submit">Đăng Nhập</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <a href="{{route('register')}}"><button type="button" class="cancelbtn">Đăng ký</button></a>
        </div>
    </form>
</div>
@endsection