<form role="form" action="" method="POST">
    @csrf
    <div class="box-body">
        <div class="form-group {{ $errors->has('c_code') ? 'has-error' : '' }}">
            <div class="fs-13">
                <label for="company">Mã loại hàng <span class="title-sup">(*)</span></label>
            </div>
            <div class="col-sm-12" style="display: inline-block; padding: 0px;">
                <input class="form-control random_code" id="random_code" oninput="if(value.length>15)value=value.slice(0,15)" name="c_code" value="{{ old('c_code', isset($category) ? $category->c_code : '') }}" type="text" placeholder="VD : pZGrAb0ETI2v1gh">
            </div>
            @if($errors->has('c_code'))
                <span class="help-block">{{$errors->first('c_code')}}</span>
            @endif
            <div class="col-sm-12 default mg-t-10 mg-b-10" style="display: inline-block">
                <button class="btn btn-blue btn-info btn-change btn-change-code" ><i class="fa fa-fw fa-refresh"></i>  Tạo mã</button>
            </div>
        </div>

        <div class="form-group {{ $errors->has('c_name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1" class="mg-t-10">Tên loại mặt hàng <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" name="c_name" value="{{ old('c_name', isset($category) ? $category->c_name : '') }}" placeholder="Tên loại mặt hàng">
            @if($errors->has('c_name'))
                <span class="help-block">{{$errors->first('c_name')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('c_supplier_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Nhà cung cấp</label>
            <select name="c_supplier_id" class="form-control">
                <option value="">Chọn nhà cung cấp</option>
                @if($suppliers)
                    @foreach($suppliers as $supplier)
                        <option  {{old('c_supplier_id', isset($category) ? $category->c_supplier_id : '') == $supplier->id ? 'selected=selected' : '' }}  value="{{$supplier->id}}">{{$supplier->s_name}}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('c_supplier_id') }}</p></span>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.categories') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>