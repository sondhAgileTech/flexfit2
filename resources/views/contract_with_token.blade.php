<html>
<body>
<h1>Đây là trang hiển thị chi tiết của hợp đồng <span style="color: red">{{$data->contract_code}}</span>sau khi quét QR</h1>
<table>
    <tr><td>Mã Hợp Đồng</td><td>{{$data->contract_code}}</td></tr>
    <tr><td>Tên Khách Hàng</td><td>{{$data->name_customer}}</td></tr>
    <tr><td>Địa Chỉ</td><td>{{$data->address}}</td></tr>
    <tr><td>Số Điện Thoại</td><td>{{$data->phone}}</td></tr>
</table>
</body>
</html>