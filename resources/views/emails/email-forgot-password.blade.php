<!DOCTYPE html>
<html>
<head>
    <title>=</title>
</head>

<body>
    <p>
        Có vẻ như bạn đã quên mật khẩu của mình nhưng không sao. Bạn vui lòng kích vào link dưới đây để thực hiện đặt lại mật khẩu của mình
        <a href="{{ route('reset.password', $data['token']) }}">Đặt lại</a> mật khẩu
    </p>
</body>
</html>