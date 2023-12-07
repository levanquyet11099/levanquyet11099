
@if (!empty($productExcels))
    @foreach($productExcels as $keys => $productExcel)
        <tr location="{{ $keys }}" class="product_{{ $keys }}">
            <td>
                <select name="pw_product_id[{{ $keys }}]" id="" class="form-control select pw_product_id" required>
                    <option value="">Chọn sản phẩm</option>
                    @if($products)
                        @foreach($products as $key => $product)
                            <option {{ $product->id == $productExcel['product_id'] ? 'selected=selected' : '' }} value="{{ $product->id }}">{{ $product->p_name }}</option>
                        @endforeach
                    @endif
                </select>
            </td>
            <td>
                <select name="pw_supplier_id[{{ $keys }}]" id="" class="form-control select" required>
                    <option value="">Chọn nhà cung cấp</option>
                    @if($suppliers)
                        @foreach($suppliers as $key => $supplier)
                            <option {{ $supplier->id == $productExcel['supplier_id'] ? 'selected=selected' : '' }} value="{{ $supplier->id }}" title="{{ $supplier->s_name }}"> {{ $supplier->s_name }}</option>
                        @endforeach
                    @endif
                </select>
            </td>
            <td>
                <input type="number" class="form-control pw_total_number" name="pw_total_number[{{ $keys }}]" value="{!! $productExcel['total_number'] !!}" placeholder="Số lượng sản phẩm" required>
            </td>
            <td>
                <input type="radio" value="1" name="pw_active_price[{{ $keys }}]" {{ $productExcel['active_price'] == 1 ? 'checked' : '' }} class="pw_active_price"> Giá nhập
                <input type="radio" value="4" name="pw_active_price[{{ $keys }}]" {{ $productExcel['active_price'] == 4 ? 'checked' : '' }} class="pw_active_price"> Giá khác
                <input type="number" class="form-control pw_custom_price" name="pw_custom_price[{{ $keys }}]" value="{!! $productExcel['custom_price'] !!}" placeholder="Giá sản phẩm" style="display: {{ $productExcel['active_price'] == 4 ? 'block' : 'none' }}">
            </td>
            <td>
                <input type="date" class="form-control" name="pw_manufacturing_date[{{ $keys }}]" value="{!! $productExcel['manufacturing_date'] !!}">
            </td>
            <td>
                <input type="date" class="form-control" name="pw_expiry_date[{{ $keys }}]" value="{!! $productExcel['expiry_date'] !!}">
            </td>
            <td>
                <p class="pw_total_price"> @if (!empty($productExcel['total_price']) ) {{number_format($productExcel['total_price'], 0,',','.')}} <sup>đ</sup> @endif </p>
                <input type="hidden" class="form-control pw_total_price" name="pw_total_price[{{ $keys }}]" value="{!! $productExcel['total_price'] !!}">
            </td>
            <td><a class="btn btn-xs btn-info mg-t-5 delete-item-product"><i class="fa fa-trash-o"></i></a></td>
        </tr>
    @endforeach
@endif