@extends('front-end.master')
@section('content')
<div class="container">
    <h2>Edit User {{$user->fullname}}</h2>
    <form action="{{route('update_user')}}" method="post" style="border:1px solid #ccc">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        @foreach($role as $item)
        <div class="form-check">
            <input type="checkbox" name="role" id="$item->id">
            <label for="name">{{$item->name}}</label>
        </div>
        @endforeach
        <button type="submit" class="signupbtn">Đăng ký</button>
    </form>
</div>


<script type="text/javascript">
function getBack() {
    history.go(-1);
}
</script>

@endsection