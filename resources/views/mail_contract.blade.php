

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
<body style="margin:0; padding:0;">
   <a href='http://baohanh.flexfit.vn/hop-dong/{{$data->contract_code}}' target="_blank">
    <div style="position: relative;">
            <img style="position: absolute;z-index: 1;top: 0;left: 0;width: 100%;height: 100%;object-fit: cover;" src="{{url('/images/trang-bao-hanh_kfzpzv.jpg')}}" alt="" style="filter: brightness(80%);">
            <div style="position: absolute;text-align:center;top: 50%;left: 50%;z-index: 1;transform: translate(-50%, -50%);">
                <p style="text-transform: uppercase;color: #fff;font-size: 1.6rem;">Thông tin bảo hành</p>
                <p style="font-size: 3rem;font-weight: 300;text-transform: uppercase;color: #fff;">HĐ {{$data->contract_code}}</p>
            </div>
    </div>
    </a>
    <br>
    <span style="font-size: 16px;color: #000000;line-height: 30px;">
      <p>
          Kính gửi Quý khách <span style="font-weight: bold;">{{$data->name_customer}}</span>,
      </p>
      <p>
          Flexfit chân thành cảm ơn Quý khách đã tin tưởng lựa chọn sản phẩm của chúng tôi. Sự tin tưởng của Quý khách chính là niềm tự hào trong quá trình phát triển và khẳng định thương hiệu Flexfit.
          Chúng tôi xin phép gửi tới Quý khách thông tin bảo hành của Hợp đồng số <span style="font-weight: bold;">{{$data->contract_code}} </span> được hoàn thành vào ngày <span style="font-weight: bold;">{{$data->finish_date}}</span>. Quý khách vui lòng nhấp vào ảnh phía trên để biết thêm thông tin chi tiết.
          Chúng tôi luôn sẵn sàng hỗ trợ Quý khách, nếu Quý khách có bất cứ thắc mắc hay vấn đề gì trong quá trình sử dụng, trong trường hợp cần hỗ trợ, vui lòng liên hệ với bộ phận Chăm sóc khách hàng của chúng tôi qua số điện thoại: 1900 633 588.
          Đội ngũ Flexfit chân thành cảm ơn và hân hạnh được đồng hành cùng Quý khách kiến tạo nên những tổ ấm thẩm mỹ và tiện nghi!
      </p>
      Trân trọng,
      <p>
          Flexfit
      </p>
    </span>
</body>
</html>