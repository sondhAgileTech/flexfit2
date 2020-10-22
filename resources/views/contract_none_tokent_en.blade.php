
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
                    <a href='/api/download_file/{{$data->contract_code}}' title="" target="_blank">Click to download warranty file</a>
                </div>
            </div>
        </div>
    </section>
    <section class="detail-insuarance">
        <div class="container-master">
            <div class="detail-insuarance-title">Detailed warranty information</div>
            <div class="detail-insuarance-content">
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
                            <td>
                                <i class="glyphicon glyphicon-calendar"></i>
                                Change warranty time
                                <div class="input-group date" >
                                        <input data-now = "{{ date('Y/m/d', strtotime($now)) }}"  data-first="{{ date('Y/m/d', strtotime($data->finish_date.' + 3 months')) }}" data-seccond = "{{ date('Y/m/d', strtotime($data->finish_date.' + 6 months')) }}"  data-third = "{{ date('Y/m/d', strtotime($data->finish_date.' + 12 months')) }}" class="form-control date-change-maintain datepicker"  type="text">
                                        <input class="data-contract-product" data-contact="{{ $data->id }}" data-code="{{$data->contract_code}}" type="hidden"> 
                                        <button style="position: absolute;margin-left: 5px;" type="button" class="btn btn-success change-time-maintain-contract" data-language="{{$data->language}}">Change</button>
                                </div>
                            </td>
                        </tr>
                        @foreach($products as $list)
                            <tr>
                                <td>{{$list->name}}</td>
                                <td>{{$list->provider}}</td>
                                <td class="{{Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($data->finish_date)->addMonth(3), false) >= 0 ? 'bh-1' : 'bh-out-of-date-1' }}">{{date('d/m/Y', strtotime($data->finish_date.' + 3 months'))}}</td>
                                <td class="{{Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($data->finish_date)->addMonth(6), false) >= 0 ? '' : 'bh-out-of-date-1' }}">{{date('d/m/Y', strtotime($data->finish_date.' + 6 months'))}}</td>
                                <td class="{{Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($data->finish_date)->addMonth(12), false) >= 0 ? '' : 'bh-out-of-date-1' }}">{{date('d/m/Y', strtotime($data->finish_date.' + 12 months'))}}</td>
                                <td class="bh-4">{{$data->status_mainten ? 'Lifetime maintenance' : ''}}</td>
                                <td>
                                    <!-- <div class="input-group date" >
                                        <input data-now = "{{ date('Y/m/d', strtotime($now)) }}"  data-first="{{ date('Y/m/d', strtotime($list->finish_date.' + 3 months')) }}" data-seccond = "{{ date('Y/m/d', strtotime($list->finish_date.' + 6 months')) }}"  data-third = "{{ date('Y/m/d', strtotime($list->finish_date.' + 12 months')) }}"  class="form-control date-change-maintain datepicker"  type="text">
                                        <input class="data-contract-product" data-contact="{{ $data->id }}" data-product="{{ $list->product_id }}" data-code="{{$data->contract_code}}" type="hidden"> 
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </span>
                                    </div>
                                    <button style="margin-top:10px;" type="button" class="btn btn-success change-time-maintain" data-language="{{$data->language}}">Change</button> -->
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
                        <div class="title">We'd love to hear from you</div>
                        <div class="txt">
                            Please send these incentives to friends and relatives to experience Flextfit products and services.
                        </div>
                        <span class="success-data"></span>
                        <div class="row-input">

                            <div class="box-input">
                                <input type="text"  id="name" name="name" placeholder="Your name">
                            </div>
                            <div class="box-input">
                                <input type="text" id="phone" name="phone" placeholder="Phone">
                            </div>
                            <div class="box-input" style="width:100% !important;">
                                <input type="email" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="box-input">
                            <input type="button" data-type="{{$data->language}}" data-contract="{{$data->contract_code}}" class="btn-submit" id="register-ask-advice" value="Send incentives">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection
