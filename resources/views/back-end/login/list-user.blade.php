@extends('front-end.master')
@section('content')
<div class="container">
    <div class="container mt-3">
        <h2>Danh sách hồ sơ</h2>
        <input class="form-control" id="myInput" type="text" placeholder="Tìm kiếm..">
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại </th>
                    <th>Trạng thái</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($users as $item)
                <tr>
                    <td>{{$item->fullname}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>
                        {{ implode($item->roles()->get()->pluck('name')->toArray()) }}
                    </td>
                    <td> <a href="{{route('edit_user',$item->id)}}"><i class="fa fa-edit"
                                style="text-align: center;display: block;"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- <a href="{{route('register')}}"><button class="btn" style="width: 200px;">Đăng ký hồ sơ</button></a> -->
        <br>
    </div>
</div>



<script>
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endsection