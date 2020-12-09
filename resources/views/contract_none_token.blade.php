
@extends('layouts.index')

@section('content')
<style>
.bh-out-of-date-1 {
    text-decoration: line-through !important;
    color: #666;
}
.bh-out-of-date-2 {
    /* text-decoration: line-through !important;
    color: #666; */
}
.bh2-class {
    text-decoration: line-through !important;
    color: #666;
}
.bh3-class {
    text-decoration: line-through !important;
    color: #666;
}
.bh-2 {
    color: #0ACF83 !important;
}
.bh-3 {
    color: #0ACF83 !important;
}
.bh-4 {
    color:#31BAF5 !important;
}
.success-data {
    display: block;
    text-align: center;
    color: #0ACF83;
    padding-bottom: 20px;
}
.error {
    border:2px solid #FF0000 !important;
}
.question-insuarance {
    text-align: center;
}
#ss-header .ss-navbar-menu > ul > li > a {
    color:#a6a6a6;
    letter-spacing: .3px;
}
#ss-header .ss-navbar-menu > ul > li:hover > a {
    color:#404040;
}
#ss-header .ss-navbar-menu > ul > li.active > a {
    color:#404040;
}
</style>
<main id="insuarance-wrapper">
    <section class="section-banner">
        <div class="imgc">
            <img src="images/trang-bao-hanh_kfzpzv.jpg" alt="" style="filter: brightness(80%);">
            <div class="text">
                <p>Thông tin bảo hành</p>
                <p>HĐ {{$data->contract_code}}</p>
            </div>
        </div>
    </section>
    <section class="info-insuarance">
        <div class="container-master">
            <div class="info-insuarance-title">Thông tin hợp đồng</div>
            <div class="info-insuarance-content">
                <div class="box-info">
                    <div class="item">
                        <span>Họ và tên khách hàng:</span>
                        <span>{{$data->name_customer}}</span>
                    </div>
                    <div class="item">
                        <span>Địa chỉ:</span>
                        <span>{{$data->address}}</span>
                    </div>
                    <div class="item">
                        <span>Số điện thoại:</span>
                        <span>{{$data->phone}}</span>
                    </div>
                    <div class="item">
                        <span>Mã hợp đồng:</span>
                        <span>{{$data->contract_code}}</span>
                    </div>
                    <div class="item">
                        <span>Hạng mục hợp đồng:</span>
                        <span>{{$data->construction_items}}</span>
                    </div>
                    <div class="item">
                        <span>Ngày hoàn thành:</span>
                        <span>{{date('d/m/Y', strtotime($data->finish_date))}}</span>
                    </div>
                </div>
                <div class="qr-code">
                    <div class="box-qr" style="width: 228px;height: 224px;background-color: darkgray;">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->merge('images/logo-flextfit.jpg', 0.2, true)
                        ->size(400)->errorCorrection('H')
                        ->generate(env('APP_URL').'/'.$token)) !!} ">
                    </div>
                    @if($data->file_upload)
                        <a class="download-file" data-code="{{$data->contract_code}}" title="" target="_blank">Click để tải file bảo hành</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="detail-insuarance">
        <div class="container-master">
            <div class="detail-insuarance-title">Thông tin bảo hành chi tiết</div>
            <div class="detail-insuarance-content">
                <div class="cb"></div>
                <div class="info-detail-insuarance">
                    <table>
                        <tr>
                            <td>Hạng mục</td>
                            <td>Đơn vị cung cấp</td>
                            <td>Lịch kiểm tra định kỳ lần 1</td>
                            <td>Lịch kiểm tra định kỳ lần 2</td>
                            <td>Lịch kiểm tra định kỳ lần 3</td>
                            <td>Bảo hành</td>
                            <td>
                                <i class="glyphicon glyphicon-calendar"></i> 
                                Đổi lịch kiểm tra
                                <div class="input-group date" >
                                        <input data-now = "{{ date('Y/m/d', strtotime($now)) }}"  data-first="{{ date('Y/m/d', strtotime($data->finish_date.' + 3 months')) }}" data-seccond = "{{ date('Y/m/d', strtotime($data->finish_date.' + 6 months')) }}"  data-third = "{{ date('Y/m/d', strtotime($data->finish_date.' + 12 months')) }}" class="form-control date-change-maintain datepicker"  type="text">
                                        <input class="data-contract-product" data-contact="{{ $data->id }}" data-code="{{$data->contract_code}}" type="hidden"> 
                                        <button style="position: absolute;margin-left: 5px;" type="button" class="btn btn-success change-time-maintain-contract" data-language="{{$data->language}}">Thay đổi</button>
                                </div>
                            </td>
                        </tr>
                        @foreach($products as $list)
                            <tr>
                                <td>{{$list->name}}</td>
                                <td>{{$list->provider}}</td>
                                <td class="{{Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($list->guarantee_one), false) >= 0 ? 'bh-1' : 'bh-out-of-date-1' }}">{{date('d/m/Y', strtotime($list->guarantee_one))}}</td>
                                <td class="{{Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($list->guarantee_two), false) >= 0 ? '' : 'bh-out-of-date-1' }}">{{date('d/m/Y', strtotime($list->guarantee_two))}}</td>
                                <td class="{{Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($list->guarantee_three), false) >= 0 ? '' : 'bh-out-of-date-1' }}">{{date('d/m/Y', strtotime($list->guarantee_three))}}</td>
                                <td class="bh-4">{{$data->status_mainten ? 'Trọn đời' : ''}}</td>
                                <td>
                                    <!-- <div class="input-group date" >
                                        <input data-now = "{{ date('Y/m/d', strtotime($now)) }}"  data-first="{{ date('Y/m/d', strtotime($list->guarantee_one)) }}" data-seccond = "{{ date('Y/m/d', strtotime($list->guarantee_two)) }}"  data-third = "{{ date('Y/m/d', strtotime($list->guarantee_three)) }}"  class="form-control date-change-maintain datepicker"  type="text">
                                        <input class="data-contract-product" data-contact="{{ $data->id }}" data-product = "{{ $list->product_id }}" data-code="{{$data->contract_code}}" type ="hidden"> 
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </span>
                                    </div>
                                    <button style="margin-top:10px;" type="button" class="btn btn-success change-time-maintain" data-language="{{$data->language}}">Thay đổi</button> -->
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-master">
            <div class="thank-insuarance">
                <div class="text">
                    @if($content_text != null)
                        @foreach($content_text as $item)
                            @if ($loop->last)
                                {!! $item->content !!}
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-master">
            <div class="question-insuarance">
                <div class="question-insuarance-title">Câu hỏi thường gặp</div>
                <div class="question-insuarance-content">
                    @foreach($question_answer as $list)
                        <button class="accordion"><span>{{$list->question}}</span></button>
                        <div class="panel">
                            <div class="txt" style="text-align: left;">
                                {{$list->answer}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-master">
            <div class="question-insuarance">
                <img src="images/gift-v.png"/>
            </div>
        </div>
    </section>
    <section>
        <div class="container-master">
            <div class="form-request">
                <form>
                    {{ csrf_field()}}
                    <div class="box-form">
                        <div class="title">Bạn tin tưởng Flexfit?</div>
                        <div class="txt">
                            Gửi những ưu đãi này cho bạn bè và người thân để trải nghiệm sản phẩm và dịch vụ của Flextfit 
                        </div>
                        <span class="success-data"></span>
                        <div class="row-input">
                            <div class="box-input">
                                <input type="text" id="name" name="name" placeholder="Tên người nhận">
                            </div>
                            <div class="box-input">
                                <input type="text" id="phone" name="phone" placeholder="Số điện thoại người nhận">
                            </div>
                            <div class="box-input" style="width:100% !important;">
                                <input type="email" id="email" name="email" placeholder="Email người nhận">
                            </div>
                        </div>
                        <div class="box-input">
                            <input type="button" data-contract="{{$data->contract_code}}" data-type="{{$data->language}}" id="register-ask-advice" class="btn-submit" value="Gửi tặng ưu đãi">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection


<!-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->merge('images/logo.png', 0.2, true)
                        ->size(300)->errorCorrection('H')
                        ->generate(env('APP_URL').'/'.$token)) !!} "> -->
