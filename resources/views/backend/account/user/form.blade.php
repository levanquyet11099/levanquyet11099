<form role="form" method="post">
    <div class="box-body">
        <div class="form-group {{ $errors->has('account') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Tên tài khoản <sup class="title-sup">(*)</sup></label>
            <input type="text" name="account" class="form-control" value="{{old('account', isset($user->account) ? $user->account : '')}}" {{isset($user->account) && !empty($user->account) ? 'disabled' : ''}} id="exampleInputEmail1" placeholder="Tài khoản">
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('account') }}</p></span>
            <p class="help-block"><i>Tên tài khoản không được chứa khoảng trắng</i>.</p>
        </div>
        @if( !isset($user->password) && empty($user->password))
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Mật khẩu  <sup class="title-sup">(*)</sup></label>
                <input type="password" name="password" class="form-control" value="" id="exampleInputEmail1" placeholder="Mật khẩu">
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
            </div>
        @endif

        <div class="form-group {{ $errors->has('full_name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Họ và tên <sup class="title-sup">(*)</sup></label>
            <input type="text" name="full_name" class="form-control" value="{{old('full_name', isset($user->full_name) ? $user->full_name : '')}}" id="exampleInputEmail1" placeholder="Nguyễn Văn ...">
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('full_name') }}</p></span>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Email <sup class="title-sup">(*)</sup></label>
            <input type="email" name="email" class="form-control" value="{{old('email', isset($user->email) ? $user->email : '')}}" id="exampleInputEmail1" placeholder="email">
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
        </div>

        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Số điện thoại<sup class="title-sup">(*)</sup></label>
            <input type="text" name="phone" class="form-control" value="{{old('phone', isset($user->phone) ? $user->phone : '')}}" id="exampleInputEmail1" placeholder="09288.....">
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
        </div>

        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Vai trò <sup class="title-sup">(*)</sup></label>
            <select name="role" class="form-control">
                <option value="">Chọn vai trò của thành viên</option>
                @if($roles)
                    @foreach($roles as $role)
                        <option  {{old('role', isset($listRoleUser->role_id) ? $listRoleUser->role_id : '') == $role->id ? 'selected=selected' : '' }}  value="{{$role->id}}">{{$role->display_name}}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('role') }}</p></span>
        </div>

        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Trạng thái</label>
            <div class="checkbox" style="display: inline">
                <label>
                    <input type="radio" name="status" {{ isset($user) && $user->status == 1 ? "checked='checked'" : "checked='checked'"  }} value="1"> Hoạt động
                </label>
            </div>
            <div class="checkbox" style="display: inline">
                <label>
                    <input type="radio" name="status" {{ isset($user) && $user->status == 0 ? "checked='checked'" : ""  }} value="0"> Không hoạt động
                </label>
            </div>
            @if($errors->has('status'))
                <span class="help-block">{{$errors->first('status')}}</span>
            @endif
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.user') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>