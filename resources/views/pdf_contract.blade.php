<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Violet</title>
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
    </style>
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body>
    <!-- <section class="section-guarantee">
        <img src="{{url('/images/img1.jpg')}}" alt="">
    </section> -->
    <section class="section-thanks">
        <!-- <img src="{{url('/images/img2.jpg')}}" alt=""> -->
        <!-- <h5 style="float:right;margin-right:65px;">Thông tin bảo hành</h5> -->
        <div class="box-qr">
            <div class="qr-code" style="width:200px;">
                <img class="test" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->merge('images/logo-flextfit.jpg', 0.2, true)
                        ->size(400)->errorCorrection('H')
                        ->generate(env('APP_URL').'/'.$token)) !!} ">
            </div>
        </div>
    </section>
</body>
</html>