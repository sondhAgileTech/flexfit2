
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
                <p>WARRANTY INFORMATION</p>
                <p>code {{$data->contract_code}}</p>
            </div>
        </div>
    </section>
    <section class="info-insuarance">
        <div class="container-master">
            <div class="info-insuarance-title">Contract information</div>
            <div class="info-insuarance-content">
                <div class="box-info">
                    <div class="item">
                        <span>Full name of customer:</span>
                        <span>{{$data->name_customer}}</span>
                    </div>
                    <div class="item">
                        <span>Address:</span>
                        <span>{{$data->address}}</span>
                    </div>
                    <div class="item">
                        <span>Phone number:</span>
                        <span>{{$data->phone}}</span>
                    </div>
                    <div class="item">
                        <span>Contract Code:</span>
                        <span>code {{$data->contract_code}}</span>
                    </div>
                    <div class="item">
                        <span>Contract category:</span>
                        <span>{{$data->construction_items}}</span>
                    </div>
                    <div class="item">
                        <span>Finish day:</span>
                        <span>{{date('d/m/Y', strtotime($data->finish_date))}}</span>
                    </div>
                </div>
                <div class="qr-code">
                    <div class="box-qr" style="width: 228px;height: 224px;background-color: darkgray;">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->merge('images/logo-flextfit.jpg', 0.2, true)
                        ->size(300)->errorCorrection('H')
                        ->generate(env('APP_URL').'/'.$token)) !!} ">
                    </div>
                    <a href="" title="">Click to download warranty file</a>
                </div>
            </div>
        </div>
    </section>
    <section class="detail-insuarance">
        <div class="container-master">
            <div class="detail-insuarance-title">Detailed warranty information</div>
            <div class="detail-insuarance-content">
                <div class="note">
                    <div class="note-title">Note</div>
                    <div class="item">
                        <span class="bh-one">02/02/2020:</span> Warranty has passed
                    </div>
                    <div class="item">
                        <span class="bh-two">02/02/2020:</span> Next warranty
                    </div>
                    <div class="item">
                        <span class="bh-three">02/02/2020:</span> Future warranty times
                    </div>
                </div>
                <div class="cb"></div>
                <div class="info-detail-insuarance">
                    <table>
                        <tr>
                            <td>Categories</td>
                            <td>Unit of supply</td>
                            <td>Warranty 1</td>
                            <td>Warranty 2</td>
                            <td>Warranty 3</td>
                            <td>Maintenance</td>

                        </tr>
                        @foreach($products as $list)
                            <tr>
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
                <div class="question-insuarance-title">Frequently asked questions</div>
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
                        <div class="title">Do you trust Flexfit?</div>
                        <div class="txt">
                            Along with Flexfit's design team, each space of your house Flexfit is a retail brand
                        </div>
                        <span class="success-data"></span>
                        <div class="row-input">

                            <div class="box-input">
                                <input type="text"  id="name" name="name" placeholder="your name">
                            </div>

                            <div class="box-input">
                                <input type="number" id="phone" name="phone" placeholder="your number">
                            </div>
                        </div>
                        <div class="box-input">
                            <input type="button" data-type="{{$data->language}}" class="btn-submit" id="register-ask-advice" value="Ask for advice">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="container-master">
            <div class="news-other">
                <div class="news-other-title">related news</div>
                <div class="news-other-content">
                    <div class="box-item">
                        <div class="item">
                            <div class="item-img">
                                <a href="" class="imgc" title=""><img src="images/1.png" alt=""></a>
                            </div>
                            <div class="item-body">
                                <div class="item-title"><a href="" title="">Product's name</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item">
                            <div class="item-img">
                                <a href="" class="imgc" title=""><img src="images/1.png" alt=""></a>
                            </div>
                            <div class="item-body">
                                <div class="item-title"><a href="" title="">Product's name</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item">
                            <div class="item-img">
                                <a href="" class="imgc" title=""><img src="images/1.png" alt=""></a>
                            </div>
                            <div class="item-body">
                                <div class="item-title"><a href="" title="">Product's name</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
