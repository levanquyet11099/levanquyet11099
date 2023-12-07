<div class="col-md-8 default">
    <p><b>Mã đơn hàng : {{ $warehousing->w_code }}</b></p>
    <p><b>Người nhập : {{ $warehousing->user->full_name }}</b></p>
    <p><b>Nội dung nhập hàng : {{ $warehousing->w_name }}</b></p>
    @if (!empty( $warehousing->w_note ))
    <p><b>Ghi chú : {{ $warehousing->w_note  }}</b></p>
    @endif
    <p><b>Ngày tạo : {{ $warehousing->created_at  }}</b></p>
</div>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th style="width: 2%;" class="text-center">STT</th>
            <th>Tên sản phẩm</th>
            <th>Nhà cung cấp</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Đơn vị</th>
            <th>Ngày sản xuất</th>
            <th>Ngày hạn hết hạn</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        @foreach($products as $key => $product)
            <tr>
                <td style="width: 2%;">{{ $key + 1 }}</td>
                <td>{{ $product->product->p_name }}</td>
                <td>{{ $product->supplier->s_name }}</td>
                <td>{{ $product->pw_total_number }}</td>
                <td>
                    @switch($product->pw_active_price)
                        @case(1)
                            {{ number_format($product->product->p_entry_price, 0, ',', '.') }}<sup>đ</sup>
                        @break
                        @case(2)
                            {{ number_format($product->product->p_retail_price, 0, ',', '.') }}<sup>đ</sup>
                        @break
                        @case(3)
                            {{ number_format($product->product->p_cost_price, 0, ',', '.') }}<sup>đ</sup>
                        @break
                        @case(4)
                            {{ number_format($product->pw_custom_price, 0, ',', '.') }}<sup>đ</sup>
                        @break
                        @default
                            {{ number_format($product->product->p_entry_price, 0, ',', '.') }}<sup>đ</sup>
                        @break
                    @endswitch
                </td>
                <td>{{ $product->product->unit->u_name }}</td>
                <td>{{ $product->pw_manufacturing_date }}</td>
                <td>{{ $product->pw_expiry_date }}</td>
                <td>{{ number_format($product->pw_total_price, 0, ',', '.') }}<sup>đ</sup></td>
            </tr>
            @php
                $total = $total + $product->pw_total_price;
            @endphp
        @endforeach
            <tr>
                <td colspan="7" class="text-center"> <b>Tổng giá trị nhập hàng</b> </td>
                <td colspan="2" class="text-center"> <b>{{ number_format($total, 0, ',', '.') }}<sup>đ</sup></b> </td>
            </tr>
    </tbody>
</table>

<div class="row mg-b-40 default">
    <div class="col-md-4" style="float: right; text-align: center;">
        <p><b>Người xuất hóa đơn</b></p>
        <p style="font-size: 12px;">( Ký ghi rõ họ tên )</p>
    </div>
</div>