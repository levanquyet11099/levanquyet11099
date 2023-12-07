<form role="form" method="post">
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Tên Vai trò<sup class="title-sup">(*)</sup></label>
            <input type="text" name="name" class="form-control" value="{{old('name', isset($role->display_name) ? $role->display_name : '')}}" id="exampleInputEmail1" placeholder="Tên vai trò">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Mô tả </label>
            <textarea name="description" id="" class="form-control" cols="30" rows="3" placeholder="Mô tả ...">{{old('name', isset($role->description) ? $role->description : '')}}</textarea>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Phân quyền</label>
            <div class="col-md-12 permission_role">
                @if($permissionGroups)
                    @foreach($permissionGroups as $permissionGroup)
                        <div class="role">
                            <h4 class="title-role">{{$permissionGroup->name}}</h4>
                            <div class="col-md-12 default">
                                <div class="col-md-1">
                                    <a class="btn btn-block btn-success btn-sm checkAll" href="#" type="checkbox"  title="Chọn tất cả" onclick="$('.{{safeTitle($permissionGroup->name)}}').prop('checked', true);return false;">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Chọn tất cả
                                    </a>
                                </div>
                                <div class="col-md-1" style="margin-left: 20px;">
                                    <a class="btn btn-block btn-primary btn-sm canceAll" href="#" type="checkbox"  title="Hủy tất cả" onclick="$('.{{safeTitle($permissionGroup->name)}}').prop('checked', false);return false;">
                                        <i class="fa fa-times" aria-hidden="true"></i> Hủy tất cả
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12 content-role default">
                                @foreach($permissionGroup->permissions as $permissions)
                                    <div class="col-xs-4">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" class="{{safeTitle($permissionGroup->name)}}"
                                                       {{ isset($listPermission) && in_array($permissions->id, $listPermission) ? 'checked' : '' }}
                                                       value="{{$permissions->id}}" name="permissions[]"> {{$permissions->display_name}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.role') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>