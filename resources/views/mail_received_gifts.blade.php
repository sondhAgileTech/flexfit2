

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>

  <style type="text/css">
    p {
        color: #000000 !important;
    }
  </style>    
</head>
<body>
    <div style="background:#ffffff;">
        <div>
            <h2 style="margin-top:30px;color: #000000;">{{$infoContract->name_customer}} đã gửi tặng quý khách phiếu quà tặng từ Flexfit</h2>
        </div>
        <div>
            <a href="https://flexfit.vn/tktb">
                <img src="{{url('/images/img_banner_gift.png')}}" style="max-width:100%;height:auto;"/>
            </a>
        </div>

        <div style="font-size: 22px;color: #000000;">
            <div>
                <p>Flexfit kính chào quý khách {{$receiver}},</p>

                <p>Flexfit là <span style="font-weight:bold;color: #000000;">đơn vị thiết kế - thi công nội thất trọn gói </span> với thế mạnh là các sản phẩm từ gỗ công nghiệp.</p>

                <p>Trong thời gian vừa qua, một người bạn của quý khách - anh/chị {{$infoContract->name_customer}} đã thi công <span style="font-weight:bold;color: #000000;"> {{$infoContract->construction_items}} </span> tại địa chỉ {{$infoContract->address}}.</p>

                <p>Với sự hài lòng về dịch vụ và đội ngũ của Flexfit, anh/chị {{$infoContract->name_customer}} đã gửi tặng quá khách <span style="font-weight:bold;color: #000000;">phiếu quà tặng ưu đãi 15% các hạng mục gỗ và phụ kiện </span> khi quý khách thi công nội thất tại Flexfit.</p>

                <p>Để nhận phiếu quà tặng, quý khách vui lòng xác nhận bằng cách click vào <span style="font-weight:bold;color: #000000;">"NHẬN QUÀ TẶNG"</span> ở voucher bên dưới.</p>

                <p>Hy vọng rằng Flexfit sẽ có cơ hội đồng hành cùng quý khách kiến tạo nên những tổ ấm thẩm mỹ và tiện nghi.</p>

                <p>Trân trọng,</p>

                <p><span style="font-weight:bold;color: #000000;">Flexfit</span></p>
            </div>
        </div>

        <div style="margin-left: 100px;margin-right: 265px;">
            <a href="http://baohanh.flexfit.vn/mail/received_gift/{{$advice_id}}">
                <img src="{{url('/images/img_gift_2.png')}}" style="max-width:100%;height:auto;"/>
            </a>
        </div>

    </div>
</body>
</html>