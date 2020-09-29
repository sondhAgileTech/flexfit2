

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
<body style="margin:0; padding:0; background-color:#F2F2F2;">
  <center>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bgcolor="#F2F2F2">
        <thead>
          <tr style="background:#5b9bd5;">
            <th  align="center" valign="top"># Mã hợp đồng</th>
            <th  align="center" valign="top">Tên khách hàng</th>
            <th  align="center" valign="top">Tên sản phẩm</th>
            <th  align="center" valign="top">Số điện thoại</th>
            <th  align="center" valign="top">Địa chỉ</th>
            <th  align="center" valign="top">Ngày hoàn thành</th>
            <th  align="center" valign="top">Ngày bảo hành</th>
          </tr>
        </thead>
        <tbody>
            @foreach($products as $list)
                <tr style="background:#ddebf7;">
                    <td style="padding:10px;" align="center" valign="top">{{ $data->contract_code }}</td>
                    <td style="padding:10px;" align="center" valign="top">{{ $data->name_customer }}</td>
                    <td style="padding:10px;" align="center" valign="top">{{ $list['name'] }}</td>
                    <td style="padding:10px;" align="center" valign="top">{{ $data->phone }}</td>
                    <td style="padding:10px;" align="center" valign="top">{{ $data->address }}</td>
                    <td style="padding:10px;" align="center" valign="top">{{ date('d/m/Y', strtotime($data->finish_date))}}</td>
                    @if(date('Y/m/d', strtotime($now)) <= date('Y/m/d', strtotime($data->finish_date.' + 3 months')))
                        <td style="padding:10px;" align="center" valign="top">{{  date('d/m/Y', strtotime($data->finish_date.' + 3 months')) }}</td>
                    @elseif(date('Y/m/d', strtotime($now)) > date('Y/m/d', strtotime($data->finish_date.' + 3 months')) && date('Y/m/d', strtotime($now)) <= date('Y/m/d', strtotime($data->finish_date.' + 6 months')))
                        <td style="padding:10px;" align="center" valign="top">{{  date('d/m/Y', strtotime($data->finish_date.' + 6 months')) }}</td>
                    @elseif(date('Y/m/d', strtotime($now)) > date('Y/m/d', strtotime($data->finish_date.' + 6 months')) && date('Y/m/d', strtotime($now)) <= date('Y/m/d', strtotime($data->finish_date.' + 12 months')))
                        <td style="padding:10px;" align="center" valign="top">{{ date('d/m/Y', strtotime($data->finish_date.' + 12 months')) }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
  </center>
</body>
</html>