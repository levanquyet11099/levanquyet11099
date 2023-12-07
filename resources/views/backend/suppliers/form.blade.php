<form role="form" action="" method="POST">
    @csrf
    <div class="box-body">
        <div class="form-group {{ $errors->has('s_code') ? 'has-error' : '' }}">
            <div class="fs-13">
                <label for="company">Mã nhà cung cấp <span class="title-sup">(*)</span></label>
            </div>
            <div class="col-sm-12" style="display: inline-block; padding: 0px;">
                <input class="form-control random_code" id="random_code" oninput="if(value.length>15)value=value.slice(0,15)" name="s_code" value="{{ old('s_code', isset($supplier) ? $supplier->s_code : '') }}" type="text" placeholder="Mã nhà cung cấp">
            </div>
            @if($errors->has('s_code'))
                <span class="help-block">{{$errors->first('s_code')}}</span>
            @endif
            {{--<div class="col-sm-12 default mg-t-10 mg-b-10" style="display: inline-block">--}}
                {{--<button class="btn btn-blue btn-info btn-change btn-change-code" ><i class="fa fa-fw fa-refresh"></i>  Tạo mã</button>--}}
            {{--</div>--}}
        </div>

        <div class="form-group {{ $errors->has('s_name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1" class="mg-t-10">Tên nhà cung cấp <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" name="s_name" value="{{ old('s_name', isset($supplier) ? $supplier->s_name : '') }}" placeholder="Tên nhà cung cấp">
            @if($errors->has('s_name'))
                <span class="help-block">{{$errors->first('s_name')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('s_email') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Email <sup class="title-sup">(*)</sup></label>
            <input type="email" class="form-control" name="s_email" value="{{ old('s_email', isset($supplier) ? $supplier->s_email : '') }}" placeholder="example@gmail.com">
            @if($errors->has('s_email'))
                <span class="help-block">{{$errors->first('s_email')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('s_phone') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Phone <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" name="s_phone" value="{{ old('s_phone', isset($supplier) ? $supplier->s_phone : '') }}" placeholder="09288*****">
            @if($errors->has('s_phone'))
                <span class="help-block">{{$errors->first('s_phone')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('s_fax') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Fax</label>
            <input type="text" class="form-control" name="s_fax" value="{{ old('s_fax', isset($supplier) ? $supplier->s_fax : '') }}" placeholder="Fax ...">
            @if($errors->has('s_fax'))
                <span class="help-block">{{$errors->first('s_fax')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('s_website') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Website</label>
            <input type="text" class="form-control" name="s_website" value="{{ old('s_website', isset($supplier) ? $supplier->s_website : '') }}" placeholder="Website ...">
            @if($errors->has('s_website'))
                <span class="help-block">{{$errors->first('s_website')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('s_status') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Trạng thái <sup class="title-sup">(*)</sup></label> &nbsp;
            <div class="checkbox" style="display: inline">
                <label>
                    <input type="radio" value="1" name="s_status" {{ old('p_status', isset($supplier) ?  $supplier->s_status : '') == 1 ? "checked='checked'" : ""  }}> Đang cung cấp
                </label>
            </div>
            <div class="checkbox" style="display: inline">
                <label>
                    <input type="radio" value="0" name="s_status" {{ old('p_status', isset($supplier) ?  $supplier->s_status : '') == 0 ? "checked='checked'" : ""  }}> Dừng cung cấp
                </label>
            </div>

            @if($errors->has('s_status'))
                <span class="help-block">{{$errors->first('s_status')}}</span>
            @endif
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.suppliers') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>