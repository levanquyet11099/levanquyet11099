<form role="form" method="post">
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Tên quyền<sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" maxlength="100" name="name" value="{{old('name', isset($permission->display_name) ? $permission->display_name : '')}}" placeholder="Tên quyền">
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
        </div>
        <div class="form-group {{ $errors->has('group_permission_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Nhóm quyền<sup class="title-sup">(*)</sup></label>
            <select name="group_permission_id" class="form-control">
                <option value="">Chọn nhóm quyền</option>
                @if($permissionGroups)
                    @foreach($permissionGroups as $permissionGroup)
                        <option
                                {{old('group_permission_id', isset($permission->group_permission_id) ? $permission->group_permission_id : '') == $permissionGroup->id ? 'selected="selected"' : ''}}
                                value="{{$permissionGroup->id}}"
                        >
                            {{$permissionGroup->name}}
                        </option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('group_permission_id') }}</p></span>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Mô tả </label>
            <textarea name="description" id="" class="form-control" cols="30" rows="3" placeholder="Mô tả ...">{{old('description', isset($permission->description) ? $permission->description : '')}}</textarea>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.permission') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>