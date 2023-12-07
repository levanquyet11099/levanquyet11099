<form role="form" method="post" action="">
    <div class="box-body">
        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
            <label for="inputEmail3" class="control-label default">Tên nhóm quyền <sup class="title-sup">(*)</sup></label>
            <div>
                <input type="text" maxlength="100" class="form-control"  placeholder="Tên nhóm quyền :  Hệ thống, Văn Bản, Loại văn bản ..." name="name" value="{{ old('name',isset($permissionGroup) ? $permissionGroup->name : '') }}">
                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
            </div>
        </div>
        <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
            <label for="inputEmail3" class="control-label default">Mô tả chi tiết</label>
            <div>
                <textarea name="description" style="resize:vertical" class="form-control" placeholder="Mô tả sơ qua về nhóm quyền ...">{{ old('description',isset($permissionGroup) ? $permissionGroup->description : '') }}</textarea>
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.group-permission') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>