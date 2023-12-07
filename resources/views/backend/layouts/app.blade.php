<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','Quản Lý Kho Hàng')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/jquery-confirm/dist/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/AdminLTE.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/skins/_all-skins.min.css') }}">
{{--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">--}}
    <link rel="stylesheet" href="{{ asset('admin/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <script src="{!! asset('admin/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('admin/ckfinder/ckfinder.js') !!}"></script>
    <script src="{!! asset('admin/js/func_ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/')!!}"
    </script>
    <![endif]-->
    <!-- Google Font -->
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
    @yield('style')
    <style>
        .main_content { margin-top: 20px}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Q</b>L</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Quản Lý</b> Kho Hàng</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><i class="fa fa-fw fa-sign-out"></i> {{Auth::user()->first_name}} {{Auth::user()->	last_name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    Tên tài khoản : {{Auth::user()->account}}
                                    <small>Email : {{Auth::user()->email}}</small>
                                    <small>Số điện thoại : {{Auth::user()->phone}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('get.account.info')}}" class="btn btn-default btn-flat">Thông tin tài khoản</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree" style="margin-top: 20px;">

                <li {!! isset($home) ? "class='active'" : '' !!}><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>Trang chủ</span></a></li>
                <li class="header" style="text-transform: uppercase;">Thiết lập dữ liệu</li>
                <li class="treeview {!! (isset($c_menu) || isset($unit_menu) || isset($pro_menu))  ? 'active menu-open' : '' !!} " style="height: auto;">
                    <a href="#">
                        <i class="fa fa-fw fa-database"></i> <span>Dữ liệu sản phẩm</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display: {!! (isset($c_menu) || isset($unit_menu) || isset($pro_menu)) ? 'block' : 'none' !!}">
                        <li {!! isset($c_menu) ? "class='active'" : '' !!}><a href="{!! route('get.list.categories') !!}"><i class="fa fa-circle-o"></i> <span>Loại hàng</span></a></li>
                        <li {!! isset($unit_menu) ? "class='active'" : '' !!}><a href="{!! route('get.list.units') !!}"><i class="fa fa-circle-o"></i> <span>Đơn vị tính</span></a></li>
                        <li {!! isset($pro_menu) ? "class='active'" : '' !!}><a href="{!! route('get.list.products') !!}"><i class="fa fa-circle-o"></i> <span>Sản phẩm</span></a></li>
                    </ul>
                </li>

                <li {!! isset($sup_menu) ? "class='active'" : '' !!}><a href="{!! route('get.list.suppliers') !!}"><i class="fa fa-fw fa-cubes"></i> <span>Nhà cung cấp</span></a></li>
                <li class="header" style="text-transform: uppercase;">Dữ liệu nhập xuất</li>
                <li class="treeview {!! (isset($import_menu) || isset($import_list_product))   ? 'active menu-open' : '' !!}"  style="height: auto;">
                    <a href="#">
                        <i class="fa fa-fw fa-download"></i> <span>Dữ liệu nhập hàng</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {!! isset($import_menu) ? "class='active'" : '' !!}><a href="{!! route('get.list.goods_issue.products') !!}"><i class="fa fa-circle-o"></i> <span>Nhập hàng</span></a></li>
                        <li {!! isset($import_list_product) ? "class='active'" : '' !!}><a href="{{ route('get.list.product.goods_issue') }}"><i class="fa fa-circle-o"></i> <span>Sản phẩm đã nhập</span></a></li>
                    </ul>
                </li>
                <li class="treeview {!! (isset($export_menu) || isset($export_list_product))   ? 'active menu-open' : '' !!}" style="height: auto;">
                    <a href="#">
                        <i class="fa fa-fw fa-ambulance"></i> <span>Dữ liệu xuất hàng</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {!! isset($export_menu) ? "class='active'" : '' !!}><a href="{!! route('get.list.export.products') !!}"><i class="fa fa-circle-o"></i> <span>Xuất hàng</span></a></li>
                        <li {!! isset($export_list_product) ? "class='active'" : '' !!}><a href="{!! route('get.list.export.product.goods_issue') !!}"><i class="fa fa-circle-o"></i> <span>Sản phẩm đã xuất</span></a></li>
                    </ul>
                </li>
                <li {!! isset($warehouse) ? "class='active'" : '' !!}><a href="{!! route('get.list.warehouse') !!}"><i class="fa fa-fw fa-th-large"></i> <span>Dữ liệu kho hàng</span></a></li>
                <li class="header" style="text-transform: uppercase;">Báo cáo thống kê</li>
                <li {!! isset($statistical) ? "class='active'" : '' !!}><a href="{!! route('statistical') !!}"><i class="fa fa-fw fa-pie-chart"></i> <span>Thống kê nhập xuất tồn đầu</span></a></li>
                <li {!! isset($revenue) ? "class='active'" : '' !!}><a href="{!! route('revenue') !!}"><i class="fa fa-fw fa-area-chart"></i> <span>Thống kê doanh thu</span></a></li>
                <li {!! isset($quantity_statistics) ? "class='active'" : '' !!}><a href="{!! route('quantity.statistics') !!}"><i class="fa fa-fw fa-area-chart"></i> <span>Thống kê SL hàng xuất</span></a></li>
                <li class="header" style="text-transform: uppercase;">Thông tin quản trị</li>
                <li {!! isset($change_password) ? "class='active'" : '' !!}><a href="{!! route('change.password') !!}"><i class="fa fa-fw fa-lock"></i> <span>Đổi mật khẩu</span></a></li>
                <li {!! isset($admin_menu) ? "class='active'" : '' !!}><a href="{{ route('get.list.user') }}"><i class="fa fa-users"></i> <span>Quản trị viên</span></a></li>
                <li {!! isset($role_menu) ? "class='active'" : '' !!}><a href="{{ route('get.list.role') }}"><i class="fa fa-fw fa-user-secret"></i><span>Vai trò thành viên </span></a></li>
{{--                <li class="treeview">--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-fw fa-unlock-alt"></i>--}}
{{--                        <span>Phân quyền</span>--}}
{{--                        <span class="pull-right-container">--}}
{{--                            <span class="label label-primary pull-right">2</span>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                    <ul class="treeview-menu">--}}
{{--                        <li><a href="{{ route('get.list.group-permission') }}"><i class="fa fa-circle-o"></i>Danh sách nhóm quyền</a></li>--}}
{{--                        <li><a href="{{ route('get.list.permission') }}"><i class="fa fa-circle-o"></i>Danh sách quyền</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: 1500px;">
        @include('components.alert')
        @yield('content')
    <!-- Content Header (Page header) -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('admin/theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin/theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- Confirm -->
<script src="{{ asset('admin/theme/bower_components/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>--}}
<!--select2-->
<script src="{{ asset('admin/theme/bower_components/select2/dist/js/select2.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/theme/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/theme/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/theme/dist/js/demo.js') }}"></script>
<script src="{!! asset('admin/js/confirm.js') !!}"></script>
<script src="{!! asset('admin/js/main.js') !!}"></script>
<script>
    $(document).ready(function () {
        // $('.select').select2();

        setTimeout(function(){
            $('.show-notification').slideUp(2000);
        }, 3000);

        $('.sidebar-menu').tree()
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('[data-toggle="tooltip"]').tooltip();

        // Example 1
        $('.pane-hScroll').scroll(function() {
            $('.pane-vScroll').width($('.pane-hScroll').width() + $('.pane-hScroll').scrollLeft());
        });

        $('#import_excel_studdent').click(function (event) {
            $(".modal_import_excel").modal('show');
        });
    })
</script>

</body>
</html>

@yield('script')