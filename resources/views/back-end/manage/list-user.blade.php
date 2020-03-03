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
                    <th>Mã hồ sơ</th>
                    <th>Họ tên chủ hộ</th>
                    <th>Số tờ </th>
                    <th>Số thửa</th>
                    <th>Phường</th>
                    <th>Quận</th>
                    <th>Trạng thái</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody id="myTable">
                    @foreach($query as $item)
                    <tr>
                        <td>{{$item->code}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->number_t}}</td>
                        <td>{{$item->number_th}}</td>
                        <td>{{$item->ward}}</td>
                        <td>{{$item->district}}</td>
                        @if($item->status == 1)
                        <td style="color: red;">Hồ sơ bị lỗi</td>
                        @endif
                        @if($item->status == 2)
                        <td style="color: #ff9800;">đang chờ xử lý</td>
                        @endif
                        @if($item->status == 3)
                        <td style="color: #0b7dda;">đang duyệt</td>
                        @endif
                        @if($item->status == 4)
                        <td style="color: #46a049;">Đã duyệt</td>
                        @endif
                        <td> <a href="{{route('authentication_manage',$item->id)}}"><i class="fa fa-edit"
                                    style="text-align: center;display: block;"></i></a></td>
                    </tr>
                    @endforeach

            </tbody>
            <div class="link">{{ $query->links() }}</div>
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