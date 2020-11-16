<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin bảo hành Flexfit</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <base href="{{asset('')}}">
    <link rel="icon" type="image/png" href="{{asset('images/favicon/favicon01.ico')}}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/insuarance.css')}}" />
    <style>
        body, html {
        height: 100%;
        }
        .bg {
        /* The image used */
        background-image: url("{{asset('images/background-form-info.jpg')}}");

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        }

        .bg:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,1) 66%);
        }

        .error {
            border:2px solid #FF0000 !important;
        }

        .form-right-received{
            background-image: linear-gradient(to right, transparent 48%, #fff 41%);
        }
        .title-name {
            /* margin-top:10px; */
        }

        .description-flexfit {
            font-size: 18px;
        }

        .form-group {
            font-size:22px;
        }

        .form-hidden {
            display:none;
        }

        input,select {
            padding: 7px 15px !important;
            height: 45px !important;
            border-radius: 0 !important;
            outline: none !important;
            box-shadow: none !important;
            font-size: 16px !important;
        }
        label{
            margin-bottom: 15px;
        }
        button{
            height: 45px; 
            min-width: 170px;
            border-radius: 0 !important;
            text-transform: uppercase;
            font-size: 18px !important;
            font-weight: 700;
            color: #fff !important;
            background: #606060;
        }
        button:hover{
            background: #cccccc;
        }
    </style>
</head>
<body>

    <div class="bg">
        <div class="col-md-12">
            <div class="col-md-6"></div>
            <div class="col-md-6 form-right-received" style="min-height: 100vh; padding: 10px 30px;">
                <div class="text-center title-name">
                    <img src="images/icon-flext-form.png" width="200px"/>
                </div>
                <p>
                    <div class="description-flexfit">
                        Để Flexfit có thể hỗ trợ quý khách tốt nhất, quý khách vui lòng cung cấp một số thông tin dưới đây:
                    </div>
                </p>
                <br/>
                <p>
                    <form>
                        <input type="hidden" name="advice_id" value="{{$id}}" id="advice_id">
                        <input type="hidden" name="contract_code" value="{{$contract_code}}" id="contract_code">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">1.Loại hình công trình</label>
                            <select class="form-control form-control-lg" id="type-of-project" name="typeProject">
                                <option value="">Chọn loại hình công trình</option>
                                <option value="1">Nhà mặt đất</option>
                                <option value="2">Chung cư</option>
                                <option value="3">Văn phòng</option>
                            </select>
                        </div>
                        <div class="form-group form-hidden">
                            <label>Diện tích sàn (m2)</label>
                            <input type="number" class="form-control" id="floor-area" name="floor-area" placeholder="(Nhập tại đây)">
                        </div>
                        <div class="form-group">
                            <label>2.Địa chỉ công trình</label>
                            <input type="text" class="form-control" id="construction-address" name="construction-address" placeholder="(Nhập tại đây)">
                        </div>
                        <div class="form-group">
                            <label>3.Số điện thoại liên hệ</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="(Nhập tại đây)">
                        </div>


                        <p>
                            <div class="description-flexfit">
                                Flexfit cảm ơn quý khách đã cung cấp thông tin, nhân viên của chúng tôi sẽ liên hệ với quý khách trong thời gian sớm nhất !
                            </div>
                        </p>

                        <div class="text-center" style="margin-top: 20px;">
                        <button type="submit" id="btn-send-info" class="btn" data-type="vi">Gửi đi</button>
                        </div>
                    </form>
                </p>

            </div>
        </div>

    </div>

    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $( "#type-of-project" ).change(function() {
            var type = $(this).val();
            if(type) {
                $(".form-hidden").css('display','block');
            } else {
                $(".form-hidden").css('display','none');
            }
        });

        $("#btn-send-info").click(function(e) {
            e.preventDefault();
            var typeOfProject = '';
            var floorArea = ''
            var constructionAddress = '';
            var phone = '';
            var advice_id = '';
            var contract_code = '';
            var language = $(this).attr('data-type');
            // var contract_code = $(this).attr('data-contract');


            advice_id = $('#advice_id').val();
            contract_code = $('#contract_code').val();

            if($('#type-of-project').val() == '') {
                $('#type-of-project').addClass('error');
                $('.success-data').text('');
            } else {
                $('#type-of-project').removeClass('error');
                typeOfProject = $('#type-of-project').val();
            }

            if($('#phone').val() == '') {
                $('#phone').addClass('error');
                $('.success-data').text('');
            } else {
                $('#phone').removeClass('error');
                phone = $('#phone').val();
            }

            if($('#floor-area').val() == '') {
                $('#floor-area').addClass('error');
                $('.success-data').text('');
            } else {
                floorArea = $('#floor-area').val();
                $('#floor-area').removeClass('error');
            }

            if($('#construction-address').val() == '') {
                $('#construction-address').addClass('error');
                $('.success-data').text('');
            } else {
                constructionAddress = $('#construction-address').val();
                $('#construction-address').removeClass('error');
            }
            console.log("typeOfProject" + typeOfProject + "phone" + phone + "floorArea" + floorArea + "constructionAddress" + constructionAddress);
            if(typeOfProject && phone && floorArea && constructionAddress) {
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              jQuery.ajax({
                url: "{{ url('/reciever-info') }}",
                method: 'POST',
                data: {
                    advice_id: advice_id,
                    contractCode: contract_code,
                    typeOfProject: typeOfProject,
                    phone: phone,
                    floorArea: floorArea,
                    constructionAddress: constructionAddress,
                    // contract_code: contract_code
                },
                success: function(result){
                  if(result.success.status == 200) {
                    $('#type-of-project').removeClass('error');
                    $('#floor-area').removeClass('error');
                    $('#construction-address').removeClass('error');
                    $('#phone').removeClass('error');
                    $('#type-of-project').val('');
                    $('#phone').val('');
                    $('#floor-area').val('');
                    $('#construction-address').val('');
                    if(language == 'vi') {
                      swal({
                        title: "Gửi ưu đãi thành công",
                        icon: "success",
                        button: "Đóng",
                      });
                    } else {
                      swal({
                          title: "Offer successfully sent",
                          icon: "success",
                          button: "Đóng",
                      });
                    }
                  } else {
                    if(language == 'vi') {
                        swal({
                            title: "Có lỗi xảy ra, vui lòng liên hệ quản trị viên",
                            icon: "error",
                            button: "Đóng",
                        });
                    } else {
                        swal({
                            title: "An error has occurred, please contact the administrator",
                            icon: "error",
                            button: "Đóng",
                        });
                    }
                  }
                }});
            }
          });
    </script>
</body>
</html>