@extends('backend.layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{!! $numberProduct !!}</h3>

                                <p>Số lượng loại sản phẩm đang lưu trữ</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{!! route('get.list.products') !!}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ number_format($totalInvestment, 0, ',', '.') }}<sup style="font-size: 20px">đ</sup></h3>

                                <p>Tổng vốn đầu tư</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{!! route('revenue') !!}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ number_format($totalRevenue, 0, ',', '.') }}<sup style="font-size: 20px">đ</sup></h3>

                                <p>Doanh số bán hàng</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{!! route('revenue') !!}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <?php $total = $totalRevenue - $totalInvestment > 0 ? $totalRevenue - $totalInvestment : 0 ?>
                                <h3>{{ number_format($total, 0, ',', '.') }}<sup style="font-size: 20px">đ</sup></h3>

                                <p>Lợi nhuận thu về</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{!! route('revenue') !!}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection