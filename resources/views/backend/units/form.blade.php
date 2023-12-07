<form role="form" action="" method="POST">
    @csrf
    <div class="box-body">
        <div class="form-group {{ $errors->has('u_code') ? 'has-error' : '' }}">
            <div class="fs-13">
                <label for="company">Mã đơn vị tính <span class="title-sup">(*)</span></label>
            </div>
            <div class="col-sm-12" style="display: inline-block; padding: 0px;">
                <input class="form-control random_code" id="random_code" oninput="if(value.length>15)value=value.slice(0,15)" name="u_code" value="{{ old('u_code', isset($unit) ? $unit->u_code : '') }}" type="text" placeholder="Mã đơn vị tính">
            </div>
            @if($errors->has('u_code'))
                <span class="help-block">{{$errors->first('u_code')}}</span>
            @endif
            {{--<div class="col-sm-12 default mg-t-10 mg-b-10" style="display: inline-block">--}}
                {{--<button class="btn btn-blue btn-info btn-change btn-change-code" ><i class="fa fa-fw fa-refresh"></i>  Tạo mã</button>--}}
            {{--</div>--}}
        </div>

        <div class="form-group {{ $errors->has('u_name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1" class="mg-t-10">Tên đơn vị tính <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" name="u_name" value="{{ old('u_name', isset($unit) ? $unit->u_name : '') }}" placeholder="Tên đơn vị tính">
            @if($errors->has('u_name'))
                <span class="help-block">{{$errors->first('u_name')}}</span>
            @endif
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.units') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>