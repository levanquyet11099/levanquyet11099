<form role="form" action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="box-body">
        <div class="form-group {{ $errors->has('p_code') ? 'has-error' : '' }}">
            <div class="fs-13">
                <label for="company">Mã sản phẩm <span class="title-sup">(*)</span></label>
            </div>
            <div class="col-sm-12" style="display: inline-block; padding: 0px;">
                <input class="form-control random_code" id="random_code" oninput="if(value.length>15)value=value.slice(0,15)" name="p_code" value="{{ old('p_code', isset($product) ? $product->p_code : '') }}" type="text" placeholder="Mã sản phẩm">
            </div>
            @if($errors->has('p_code'))
            <span class="help-block">{{$errors->first('p_code')}}</span>
            @endif
            <div class="col-sm-12 default mg-t-10 mg-b-10" style="display: inline-block">
            <button class="btn btn-blue btn-info btn-change btn-change-code" ><i class="fa fa-fw fa-refresh"></i>  Tạo mã</button>
            </div>
        </div>

        <div class="form-group {{ $errors->has('p_name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1" class="mg-t-10">Tên sản phẩm <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" name="p_name" value="{{ old('p_name', isset($product) ? $product->p_name : '') }}" placeholder="Tên sản phẩm">
            @if($errors->has('p_name'))
            <span class="help-block">{{$errors->first('p_name')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('p_category_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Loại sản phẩm <sup class="title-sup">(*)</sup></label>
            <select name="p_category_id" class="form-control">
                <option value="">Chọn loại sản phẩm </option>
                @if($categories)
                @foreach($categories as $category)
                <option {{old('p_category_id', isset($product) ? $product->p_category_id : '') == $category->id ? 'selected=selected' : '' }} value="{{$category->id}}">{{$category->c_name}}</option>
                @endforeach
                @endif
            </select>
            <span class="text-danger">
                <p class="mg-t-5">{{ $errors->first('p_category_id') }}</p>
            </span>
        </div>

        <div class="form-group {{ $errors->has('p_status') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Trạng thái <sup class="title-sup">(*)</sup></label> &nbsp;
            <div class="checkbox" style="display: inline">
                <label>
                    <input type="radio" value="1" name="p_status" {{ old('p_status', isset($product) ?  $product->p_status : '') == 1 ? "checked='checked'" : ""  }}> Đang quản lý
                </label>
            </div>
            <div class="checkbox" style="display: inline">
                <label>
                    <input type="radio" value="0" name="p_status" {{ old('p_status', isset($product) ?  $product->p_status : '') == 0 ? "checked='checked'" : ""  }}> Tạm dừng
                </label>
            </div>

            @if($errors->has('p_status'))
            <span class="help-block">{{$errors->first('p_status')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('p_unit_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Đơn vị tính</label>
            <select name="p_unit_id" class="form-control">
                <option value="">Chọn đơn vị tính</option>
                @if($units)
                @foreach($units as $unit)
                <option {{old('p_unit_id', isset($product) ? $product->p_unit_id : '') == $unit->id ? 'selected=selected' : '' }} value="{{$unit->id}}">{{$unit->u_name}}</option>
                @endforeach
                @endif
            </select>
            <span class="text-danger">
                <p class="mg-t-5">{{ $errors->first('p_unit_id') }}</p>
            </span>
        </div>

        <div class="form-group {{ $errors->has('p_entry_price') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Giá nhập </label>
            <input type="number" class="form-control" name="p_entry_price" value="{{ old('p_entry_price', isset($product) ? $product->p_entry_price : '') }}" oninput="if(value.length > 15 )value=value.slice(0, 15)" placeholder="Giá nhập">
            @if($errors->has('p_entry_price'))
            <span class="help-block">{{$errors->first('p_entry_price')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('p_retail_price') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Giá bán lẻ sản phẩm</label>
            <input type="number" class="form-control" name="p_retail_price" value="{{ old('p_retail_price', isset($product) ? $product->p_retail_price : '') }}" oninput="if(value.length > 15 )value=value.slice(0, 15)" placeholder="Giá bán lẻ sản phẩm">
            @if($errors->has('p_retail_price'))
            <span class="help-block">{{$errors->first('p_retail_price')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('p_cost_price') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Giá bán sỉ sản phẩm</label>
            <input type="number" class="form-control" name="p_cost_price" value="{{ old('p_cost_price', isset($product) ? $product->p_cost_price : '') }}" oninput="if(value.length > 15 )value=value.slice(0, 15)" placeholder="Giá bán sỉ sản phẩm">
            @if($errors->has('p_cost_price'))
            <span class="help-block">{{$errors->first('p_cost_price')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('p_description') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Ghi trú </label>
            <textarea name="p_description" id="" class="form-control" cols="30" rows="3" placeholder="Ghi trú ...">{{old('p_description', isset($product->description) ? $product->description : '')}}</textarea>
            @if($errors->has('p_description'))
            <span class="help-block">{{$errors->first('p_description')}}</span>
            @endif
        </div>

        <div class="form-group mg-t-20">
            <label for="inputEmail3">Ảnh sản phẩm </label>
            <div class="input-group input-file" name="images">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-choose" type="button">Choose</button>
                </span>
                <input type="text" class="form-control" placeholder='Choose a file...' style="width: 20%;" />
                <span class="input-group-btn"></span>
            </div>
            <span class="text-danger ">
                <p class="mg-t-5">{{ $errors->first('images') }}</p>
            </span>
            <img src="@if(isset($product)) {!! asset('uploads/products/'. $product->p_images) !!} @endif" alt="" class="margin-auto-div img-rounded" id="image_render" style="width: 23.6%; float: left; {{ isset($product->p_images) ? 'height: 260px;' : ''}}">
        </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.products') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>