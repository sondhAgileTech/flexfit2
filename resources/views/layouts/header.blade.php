@if($data->language === 'vi')
    <header id="ss-header">
            <div class="container-master">
                <nav class="ss-navbar">
                    <div class="ss-navbar-logo">
                        <a href=""><img src="images/Logo.png" alt=""></a>
                    </div>
                    <div class="menu-toggle">
                        <div class="one"></div>
                        <div class="two"></div>
                        <div class="three"></div>
                    </div>
                    <div class="ss-navbar-menu">
                        <ul>
                            <li class="active"><a href="" title="">Về chúng tôi</a></li>
                            <li><a href="" title="">Thiết kế tiêu biểu</a></li>
                            <li><a href="" title="">Kiến trúc sư</a></li>
                            <li><a href="" title="">Quy trình</a></li>
                            <li><a href="" title="">Tin tức</a></li>
                            <li><a href="" title="">Liên hệ</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
    </header>
@else

    <header id="ss-header">
            <div class="container-master">
                <nav class="ss-navbar">
                    <div class="ss-navbar-logo">
                        <a href=""><img src="images/Logo.png" alt=""></a>
                    </div>
                    <div class="menu-toggle">
                        <div class="one"></div>
                        <div class="two"></div>
                        <div class="three"></div>
                    </div>
                    <div class="ss-navbar-menu">
                        <ul>
                            <li class="active"><a href="" title="">About us</a></li>
                            <li><a href="" title="">Typical design</a></li>
                            <li><a href="" title="">Project</a></li>
                            <li><a href="" title="">Procedure</a></li>
                            <li><a href="" title="">News</a></li>
                            <li><a href="" title="">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
    </header>

@endif
