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
</head>
<body>
    
    @include('layouts.header')

        @yield('content')

    @include('layouts.footer')
    <div class="bg-black"></div>

    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

      $("input#phone").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
      });

      $(document).ready(function() {
        $( ".datepicker" ).datepicker({
          dateFormat: 'dd/mm/yy',
        });

        $(document).on("click",".datepicker",function() {

              var time_maintain_one = $(this).attr("data-first");
              var time_maintain_two = $(this).attr("data-seccond");
              var time_maintain_three = $(this).attr("data-third");
              var now = $(this).attr("data-now");
              var minDate = '';
              var maxDate = ''
              if(new Date(now) <= new Date(time_maintain_one)) {
                minDate = time_maintain_one;
              } else if((new Date(now) > new Date(time_maintain_one) && new Date(now) < new Date(time_maintain_two)) || (new Date(now) == new Date(time_maintain_two))) {
                minDate = time_maintain_two;
              } else if ( (new Date(now) > new Date(time_maintain_two) && new Date(now) < new Date(time_maintain_three)) || (new Date(now) == new Date(time_maintain_three))) {
                minDate = time_maintain_three;
              }
              var actualDate = new Date(`${minDate}`);
              var convertMinDate = [];
              convertMinDate.push(actualDate.getDate());
              convertMinDate.push(actualDate.getMonth() + 1);
              convertMinDate.push(actualDate.getFullYear());
              var minDatePicker = convertMinDate.join("/");
              var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate()+10);

              $( this ).datepicker({
                dateFormat: 'dd/mm/yy',
                minDate:minDatePicker,
                maxDate:newDate,
              }).datepicker("setDate", minDatePicker);
          });
      });
    </script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            } 
          });
        }

        $("td").each(function( index ) {
          if($(this).hasClass('bh-3')) {
            $(this).parent().find('.bh-out-of-date-2').addClass('bh2-class');
          }
          if($(this).hasClass('bh-out-of-date-4')) {
            $(this).parent().find('.bh-out-of-date-3').addClass('bh3-class');
            $(this).parent().find('.bh-out-of-date-2').addClass('bh2-class');
          } 
        });

        $("#register-ask-advice").click(function(e) {
            e.preventDefault();
            var name = '';
            var phone = '';
            var email = '';
            var contract_code = $(this).attr('data-contract');
            var language = $(this).attr('data-type');
            if(jQuery('#name').val() == '') {
              $('#name').addClass('error');
              $('.success-data').text('');
            } else {
               name = jQuery('#name').val();
            }
            if(jQuery('#phone').val() == '') {
              $('#phone').addClass('error');
              $('.success-data').text('');
            } else {
               phone = jQuery('#phone').val();
            }
            if(jQuery('#email').val() == '') {
              $('#email').addClass('error');
              $('.success-data').text('');
            } else {
               email = jQuery('#email').val();
            }
            if(name && phone && email && contract_code) {
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              jQuery.ajax({
                url: "{{ url('/ask-advice') }}",
                method: 'POST',
                data: {
                    name: jQuery('#name').val(),
                    phone: jQuery('#phone').val(),
                    email: jQuery('#email').val(),
                    contract_code: contract_code
                },
                success: function(result){
                  if(result.success.status == 200) {
                    $('#name').removeClass('error');
                    $('#phone').removeClass('error');
                    $('#email').removeClass('error');
                    $('#name').val('');
                    $('#phone').val('');
                    $('#email').val('');
                    if(language == 'vi') {
                      swal({
                        title: "Gửi thành công",
                        icon: "success",
                        button: "Đóng",
                      });
                    } else {
                      swal({
                          title: "Send success",
                          icon: "success",
                          button: "Đóng",
                      });
                    }
                  } else {
                    if(language == 'vi') {
                      swal({
                        title: "Gửi Thất bại",
                        icon: "success",
                        button: "Đóng",
                      });
                    } else {
                      swal({
                          title: "Sent Fail",
                          icon: "success",
                          button: "Đóng",
                      });
                    }
                  }
                }});
            }
          });

          $(".change-time-maintain").click(function(e) {
            e.preventDefault();
            var dateMaintain =  $(this).parent().find('.datepicker').val();
            var contract_id =  $(this).parent().find('.data-contract-product').attr('data-contact');
            var product_id =  $(this).parent().find('.data-contract-product').attr('data-product');
            var contract_code =  $(this).parent().find('.data-contract-product').attr('data-code');
            var language = $(this).attr("data-language");
    
            if(dateMaintain == '') {
              $(this).parent().find('.datepicker').css('border','2px solid #FF0000');
            } else {
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              jQuery.ajax({
                url: "{{ url('/changed-time-maintain') }}",
                method: 'POST',
                data: {
                  product_id: product_id,
                  contract_id: contract_id,
                  date_maintain: dateMaintain,
                  contract_code: contract_code
                },
                success: function(result){
                  if(result.success.status == 200) {
                      if(language == 'en') {
                        swal({
                          title: "Changed success",
                          icon: "success",
                          button: "Close",
                        });
                      } else {
                        swal({
                          title: "Thay đổi thành công",
                          icon: "success",
                          button: "Đóng",
                        });
                      }
                    $(this).parent().find('.datepicker').css('border','none');
                  }
                }});
            }
          });

          $(".change-time-maintain-contract").click(function(e) {
            e.preventDefault();
            var dateMaintain =  $(this).parent().find('.datepicker').val();
            var contract_id =  $(this).parent().find('.data-contract-product').attr('data-contact');
            var contract_code =  $(this).parent().find('.data-contract-product').attr('data-code');
            var language = $(this).attr("data-language");
    
            if(dateMaintain == '') {
              $(this).parent().find('.datepicker').css('border','2px solid #FF0000');
            } else {
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              jQuery.ajax({
                url: "{{ url('/changed-time-maintain-contract') }}",
                method: 'POST',
                data: {
                  contract_id: contract_id,
                  date_maintain: dateMaintain,
                  contract_code: contract_code
                },
                success: function(result){
                  if(result.success.status == 200) {
                      if(language == 'en') {
                        swal({
                          title: "Flexfit staff will contact you to reconfirm the warranty schedule with you. Sincerely thank you!",
                          icon: "success",
                          button: "Close",
                        });
                      } else {
                        swal({
                          title: "Nhân viên của Flexfit sẽ liên hệ để xác nhận lại lịch bảo hành với quý khách . Trân trọng cảm ơn!",
                          icon: "success",
                          button: "Đóng",
                        });
                      }
                    $(this).parent().find('.datepicker').css('border','none');
                  }
                }});
            }
          });
    </script>
</body>
</html>