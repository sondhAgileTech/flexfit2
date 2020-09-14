<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexFit</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <base href="{{asset('')}}">
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
            if(name && phone) {
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
                    phone: jQuery('#phone').val()
                },
                success: function(result){
                  if(result.success.status == 200) {
                    $('#name').removeClass('error');
                    $('#phone').removeClass('error');
                    $('#name').val('');
                    $('#phone').val('');
                    $('.success-data').text('Đăng ký thành công');
                    setTimeout(function(){
                      $('.success-data').text('');
                    }, 5000);
                  }
                }});
            }
          });
    </script>
</body>
</html>