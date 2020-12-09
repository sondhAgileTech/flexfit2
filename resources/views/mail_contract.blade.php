

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>

  <style type="text/css">
  </style>    
</head>
<body>
    <div>
        <a href='http://baohanh.flexfit.vn/hop-dong/{{$data->contract_code}}' target="_blank">
            <div>
                <img src="{{url('/images/img_banner_gift.png')}}" style="width: 100%;object-fit: cover;filter: brightness(80%);"/>
            </div>
        </a>
    </div>
    <br>
    <div style="font-size: 16px;color: #000000;line-height: 30px;">
        <p style="color:#000000;">
            Kính gửi Quý khách <span style="font-weight: bold;">{{$data->name_customer}}</span>,
        </p>
        <p style="color:#000000;">
            Flexfit chân thành cảm ơn Quý khách đã tin tưởng lựa chọn sản phẩm của chúng tôi.
        </p>
        <p style="color:#000000;">
            Sự tin tưởng của Quý khách chính là niềm tự hào trong quá trình phát triển và khẳng định thương hiệu Flexfit.
        </p>
        <p style="color:#000000;">
            Chúng tôi xin phép gửi tới Quý khách thông tin bảo hành của Hợp đồng số <span style="font-weight: bold;">{{$data->contract_code}} </span> được hoàn thành vào ngày <span style="font-weight: bold;">{{date('d/m/Y', strtotime($data->finish_date))}}.</span>
        </p>
        <p style="color:#000000;">
            Quý khách vui lòng nhấp vào link bên dưới để biết thêm thông tin chi tiết
        </p>
        <p style="color:#000000;">
          Chúng tôi luôn sẵn sàng hỗ trợ Quý khách, nếu Quý khách có bất cứ thắc mắc hay vấn đề gì trong quá trình sử dụng, trong trường hợp cần hỗ trợ, vui lòng liên hệ với bộ phận Chăm sóc khách hàng của chúng tôi qua số điện thoại: 1900 633 588.
        </p>
        <p style="color:#000000;">
          Đội ngũ Flexfit chân thành cảm ơn và hân hạnh được đồng hành cùng Quý khách kiến tạo nên những tổ ấm thẩm mỹ và tiện nghi!
        </p>
        </p style="color:#000000;">
            Trân trọng,
        <p style="color:#000000;">
            Flexfit
        </p>
        <br>
        <span style="font-weight:bold;font-size: 14px;color:#000000;"> Xin vui lòng click vào mã hợp đồng <a href='http://baohanh.flexfit.vn/hop-dong/{{$data->contract_code}}' target="_blank">{{$data->contract_code}}</a> để đến trang bảo hành chi tiết . Xin chân thành cảm ơn ! </span>
    </div>

</body>
</html>