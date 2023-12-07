<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/default.css') }}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box" style="width: 50%;">
    <div class="register-logo">
        <a href=""><b>Cập Nhật Thông Tin Tài Khoản</b></a>
    </div>
    <div class="register-box-body">
        @if (Session::has('danger') && ($message = Session::get('danger')))
            <div class="alert alert-danger alert-dismissible">
                <p><i class="icon fa fa-ban"></i>{!! $message !!}</p>
            </div>
        @endif
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control" placeholder="Họ và tên lót">
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('first_name') }}</p></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="Tên">
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('last_name') }}</p></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email">
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
            </div>
            <div class="form-group has-feedback">
                <input type="number" name="phone"  value="{{old('phone')}}" class="form-control" placeholder="Số điện thoại">
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-xs-6">
                    <a href="{{route('login')}}">
                        <button type="submit" style="width: 40%; float: right;" class="btn btn-primary btn-google btn-flat"><i class="fa fa-fw fa-reply" style="font-size: 14px;"></i>  Hủy </button>
                    </a>
                </div>
                <div class="col-xs-6">
                    <button type="submit" style="width: 40%;" class="btn btn-primary btn-block btn-flat"><i class="fa fa-fw fa-save"></i>Cập nhật </button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>