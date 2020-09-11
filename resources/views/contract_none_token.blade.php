<html>
<body>
<h1>Đây là trang hiển thị chi tiết của hợp đồng <span style="color: red">{{$data->contract_code}}</span></h1>

<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->merge('images/logo.png', 0.2, true)
                        ->size(300)->errorCorrection('H')
                        ->generate(env('APP_URL').'/'.$token)) !!} ">
</body>
</html>