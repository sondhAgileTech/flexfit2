
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
</style>
<main id="insuarance-wrapper">
    <section class="section-banner">
        <div class="imgc">
            <img src="images/b1.jpg" alt="">
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
                        <span>HĐ {{$data->contract_code}}</span>
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
                    <a href="" title="">Click để tải file bảo hành</a>
                </div>
            </div>
        </div>
    </section>
    <section class="detail-insuarance">
        <div class="container-master">
            <div class="detail-insuarance-title">Thông tin bảo hành chi tiết</div>
            <div class="detail-insuarance-content">
                <div class="note">
                    <div class="note-title">Chú thích</div>
                    <div class="item">
                        <span class="bh-one">02/02/2020:</span> đã qua bảo hành
                    </div>
                    <div class="item">
                        <span class="bh-two">02/02/2020:</span> lần bảo hành kế tiếp
                    </div>
                    <div class="item">
                        <span class="bh-three">02/02/2020:</span> lần bảo hành trong tương lai
                    </div>
                </div>
                <div class="cb"></div>
                <div class="info-detail-insuarance">
                    <table>
                        <tr>
                            <td>Hạng mục</td>
                            <td>Đơn vị cung cấp</td>
                            <td>Bảo hành lần 1</td>
                            <td>Bảo hành lần 2</td>
                            <td>Bảo hành lần 3</td>
                            <td>Bảo trì</td>

                        </tr>
                        @foreach($products as $list)
                            <tr class="list-maintain">
                                <td>{{$list->name}}</td>
                                <td>{{$list->provider}}</td>
                                <td class="{{$countdown_1 >= 0 ? 'bh-1' : 'bh-out-of-date-1' }}">{{date('d/m/Y', strtotime($data->finish_date.' + 3 months'))}}</td>
                                <td class="{{$countdown_2 >= 0 && $countdown_1 < 0 ? 'bh-2' : 'bh-out-of-date-2' }}">{{date('d/m/Y', strtotime($data->finish_date.' + 6 months'))}}</td>
                                <td class="{{$countdown_3 >= 0 && $countdown_2 < 0 ? 'bh-3' : 'bh-out-of-date-3' }}">{{date('d/m/Y', strtotime($data->finish_date.' + 12 months'))}}</td>
                                <td class="{{$countdown_3 < 0 ? 'bh-out-of-date-4' : '' }}" style="display:none"></td>
                                <td class="bh-4">{{$data->status_mainten ? 'Trọn đời' : ''}}</td>
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
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem eos et amet blanditiis molestias, nulla ad porro quod suscipit, laborum expedita. Earum, reprehenderit. Laborum doloribus numquam porro id magnam provident?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem eos et amet blanditiis molestias, nulla ad porro quod suscipit, laborum expedita. Earum, reprehenderit. Laborum doloribus numquam porro id magnam provident?
                    <br> <br>
                    <p style="text-align: center;"><img src="images/thank.png" alt=""></p>
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
                            <div class="txt">
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
            <div class="form-request">
                <form>
                    {{ csrf_field()}}
                    <div class="box-form">
                        <div class="title">Bạn tin tưởng Flexfit?</div>
                        <div class="txt">
                            Cùng với đội ngũ thiết kế của Flexfit vẽ nên từng không gian ngôi nhà bạn Flexfit là một thương hiệu bán lẻ
                        </div>
                        <span class="success-data"></span>
                        <div class="row-input">
                            <div class="box-input">
                                <input type="text" id="name" name="name" placeholder="Tên của bạn">
                            </div>
                            <div class="box-input">
                                <input type="number" id="phone" name="phone" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="box-input">
                            <input type="button" id="register-ask-advice" class="btn-submit" value="Yêu cầu tư vấn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="container-master">
            <div class="news-other">
                <div class="news-other-title">Tin tức liên quan</div>
                <div class="news-other-content">
                    <div class="box-item">
                        <div class="item">
                            <div class="item-img">
                                <a href="" class="imgc" title=""><img src="images/1.png" alt=""></a>
                            </div>
                            <div class="item-body">
                                <div class="item-title"><a href="" title="">Tên sản phẩm</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item">
                            <div class="item-img">
                                <a href="" class="imgc" title=""><img src="images/1.png" alt=""></a>
                            </div>
                            <div class="item-body">
                                <div class="item-title"><a href="" title="">Tên sản phẩm</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item">
                            <div class="item-img">
                                <a href="" class="imgc" title=""><img src="images/1.png" alt=""></a>
                            </div>
                            <div class="item-body">
                                <div class="item-title"><a href="" title="">Tên sản phẩm</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection


<!-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->merge('images/logo.png', 0.2, true)
                        ->size(300)->errorCorrection('H')
                        ->generate(env('APP_URL').'/'.$token)) !!} "> -->
