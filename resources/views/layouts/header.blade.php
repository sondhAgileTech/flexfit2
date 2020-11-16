@if($data->language === 'vi')
    <header id="ss-header">
            <div class="container-master">
                <nav class="ss-navbar">
                    <div class="ss-navbar-logo">
                        <a href="https://flexfit.vn"><img src="images/logo.png" alt=""></a>
                    </div>
                    <div class="menu-toggle">
                        <div class="one"></div>
                        <div class="two"></div>
                        <div class="three"></div>
                    </div>
                    <div class="ss-navbar-menu">
                        <ul>
                            <li class="active"><a href="https://flexfit.vn/ve-chung-toi" title="Về chúng tôi">Về chúng tôi</a></li>
                            <li><a href="https://flexfit.vn/tktb" title="Thiết kế tiêu biểu">Thiết kế tiêu biểu</a></li>
                            <li><a href="https://flexfit.vn/du-an" title="Dự án">Dự án</a></li>
                            <li><a href="https://flexfit.vn/quy-trinh" title="Quy trình">Quy trình</a></li>
                            <li><a href="https://flexfit.vn/tin-tuc" title="Tin tức">Tin tức</a></li>
                            <li><a href="https://flexfit.vn/thiet-ke-24h-cung-flexfit" title="Thiết kế 24h">Thiết kế 24h</a></li>
                            <li><a href="https://flexfit.vn/thiet-ke-24h-cung-flexfit" title="Shopping" class="button_shopping">SHOPPING <i class="fa fa-shopping-cart"></i></a></li>
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
                        <a href="https://flexfit.vn"><img src="images/logo.png" alt=""></a>
                    </div>
                    <div class="menu-toggle">
                        <div class="one"></div>
                        <div class="two"></div>
                        <div class="three"></div>
                    </div>
                    <div class="ss-navbar-menu">
                        <ul>
                            <li class="active"><a href="https://flexfit.vn/en/ve-chung-toi" title="">About us</a></li>
                            <li><a href="https://flexfit.vn/en/tktb" title="">Typical design</a></li>
                            <li><a href="https://flexfit.vn/en/du-an" title="">Project</a></li>
                            <li><a href="https://flexfit.vn/en/quy-trinh" title="">Procedure</a></li>
                            <li><a href="https://flexfit.vn/en/tin-tuc" title="">News</a></li>
                            <li><a href="https://flexfit.vn/en/lien-he" title="">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
    </header>

@endif
