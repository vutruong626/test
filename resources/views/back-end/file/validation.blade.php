@extends('front-end.master')
@section('content')

<br>
<div class="container">
    <h1>Hồ Sơ : {{$data->fullname}}</h1>
    <!-- <p>Please fill in this form to create an account.</p> -->
    <hr>
    <div class="row">
        <div class="col-12 col-lg-6">
            <p>Họ tên chủ hộ: <strong>{{$data->fullname}}</strong></p>

        </div>
        <div class="col-12 col-lg-6">
            <p>MHS: <strong>{{$data->code}}</strong></p>

        </div>
        <div class="col-12 col-lg-6">
            <p>Số tờ: <strong>{{$data->number_t}}</strong></p>

        </div>
        <div class="col-12 col-lg-6">
            <p>Số thửa: <strong>{{$data->number_th}}</strong></p>

        </div>
        <div class="col-12 col-lg-6">
            <p>Phường: <strong>{{$data->ward}}</strong></p>

        </div>
        <div class="col-12 col-lg-6">
            <p>Quận: <strong>{{$data->district}}</strong></p>

        </div>

    </div>

    <hr>
    @if($data->status == 1)
    @if(count($query) > 0)
    <div class="info-1222">
        <h2>Thông Tin</h2>
        @foreach($query as $item)
        <p>MHS: <strong>{{$item->mhs}}</strong></p>
        <p>Trạng thái: <strong>Hồ sơ bị lỗi</strong></p>
        <p>Ghi chú: <strong>{{$item->description}}</strong></p>
        @endforeach
    </div>
    @endif

    @endif
    @if($data->status == 3)

    @if(count($query) > 0)
    <div class="info-1222232">
        <h2>Thông Tin</h2>
        @foreach($query as $item)
        <p>MHS: <strong>{{$item->mhs}}</strong></p>
        <p>Trạng thái: <strong>đang duyệt</strong></p>
        <p>Ghi chú: <strong>{{$item->description}}</strong></p>
        @endforeach
    </div>
    @endif
    @endif
    @if($data->status == 4)
    @if(count($query) > 0)
    <div class="info-success022">
        <h2>Thông Tin</h2>
        @foreach($query as $item)
        <p>MHS: <strong>{{$item->mhs}}</strong></p>
        <p>Trạng thái: <strong>Đã duyệt</strong></p>
        <p>Ghi chú: <strong>{{$item->description}}</strong></p>
        @endforeach
    </div>
    @endif
    @endif

    <div class="container">
        @if ($message = Session::get('status'))
        <div class="alert alert-warning alert-index" role="alert">
            {{$message}}
        </div>
        <div class="clearfix"></div>
        @endif
        <button type="button" class="btn-1 btn-danger" onclick="getBack()">
            Quay lại
        </button>
        <button type="button" class="btn-1 btn-primary" data-toggle="modal" data-target="#error">
            không Xác thực
        </button>
        <button type="button" class="btn-1 btn-success" data-toggle="modal" data-target="#success">
            Xác thực
        </button>

        <!-- The Modal -->
        <div class="modal" id="error">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('cancel_brief')}}" method="post">
                            {{ csrf_field() }}
                            <p>MHS: <strong>{{$data->code}}</strong></p>
                            <input type="hidden" name="registers_id" value="{{$data->id}}">
                            <input type="hidden" name="mhs" value="{{$data->code}}">
                            <label for="description">Ghi chú</label>
                            <textarea id="description" name="description" placeholder="" style="height:200px"
                                required></textarea>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- The Modal success-->
        <div class="modal" id="success">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('success_brief')}}" method="post">
                            {{ csrf_field() }}
                            <p>MHS: <strong>{{$data->code}}</strong></p>
                            <input type="hidden" name="registers_id" value="{{$data->id}}">
                            <input type="hidden" name="mhs" value="{{$data->code}}">
                            <!-- <input type="hidden" name="status" value="{{$data->code}}"> -->
                            <label for="description">Ghi chú</label>
                            <textarea id="description" name="description" placeholder="" style="height:200px"
                                required></textarea>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

* {
    box-sizing: border-box;
}

input[type=text],
select,
textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.info-1222 {
    border: 1px solid red;
    padding: 15px;
    border-radius: 20px;
    background: antiquewhite;
}

.btn-1 {
    width: 200px;
    margin: 0px 20px;
}

.info-1222232 {
    border: 1px solid #28a745;
    padding: 15px;
    border-radius: 20px;
    background: #0b7dda;
}
.info-success022{
    border: 1px solid #28a745;
    padding: 15px;
    border-radius: 20px;
    background: #46a049;
}
</style>
<script type="text/javascript">
function getBack() {
    history.go(-1);
}
</script>
@endsection