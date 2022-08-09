<div id="result" ></div>


<div style="text-align:center;" class="">
    <div class="fieldset2">
        <input type="radio" name="packtype" value="normal" id="normal" checked>
        <label for="normal" >{{__('longtermsubscribe')}}</label>
        <input type="radio" name="packtype" value="static" id="static">
        <label for="static" >{{__('payasyougo')}}</label>
        <span class="switch2" ></span>
    </div>
</div>

<p style="text-align:center;">{{__('subscribetoourpackagenote')}}</p>
<p>&nbsp;</p>




@if((session('status')) == 'success')
    <div class="alert alert-success">
        <strong>Success!</strong> Your profile was edited succesfully !
    </div>
@elseif((session('status')) == 'validation_failed')
    <div class="alert alert-danger">
        <strong>UnSuccess!</strong> Wrong Input !
    </div>
@elseif((session('status')) == 'ads_remaining')
    <div class="alert alert-danger">
        <strong>UnSuccess!</strong> Your Package Ads Is Not Finished !
    </div>
@elseif((session('status')) == 'unsuccess')
    <div class="alert alert-danger">
        <strong>UnSuccess!</strong> Something went wrong !
    </div>
@endif




<div id="normal-div" style="" class="">
    <div class="row">
        @foreach($normals as $normal)
            <div class="col-lg-4 col-sm-6 col-md-5 f_left " style="display: flex;">
                <div class="single-listing-category" style="display: flex;width: 100%">
                    <a style="width: 100%">
                        <i class='bx bx-dollar-circle'></i>
                        {{__('kd_title')}} <strike>{{ $normal->old_price }}</strike>
                        <font style="font-size:50px;">{{ $normal->price }}</font> /
                        <font style="color:#00d683;">{{ $normal->count_day }} {{__('days')}}</font>
                        <div>
                            <p>@if(app()->getLocale()=="en"){{$normal->title_en}}@else{{$normal->title_ar}}@endif</p>
                        </div>
                        <div style="display: flex;height:200px; align-items: center;">
                            <p>@if(app()->getLocale()=="en"){{$normal->description_en}}@else{{$normal->description_ar}}@endif</p>
                        </div>

                        <div style="text-align:center">
                        <form method="post" action="{{ route('Main.buyPackageOrCredit',app()->getLocale()) }}" >
                            @csrf
                                <!--<div class="fieldset2" style="font-size: 12px;width:100%">-->
                                <!--    <input type="radio" name="payment_type" value="Cash" id="{{ "cash" . $normal->id }}" checked>-->
                                <!--    <label for="{{ "cash" . $normal->id }}" class="paytype" style="width: 50%">Pay By Cash</label>-->
                                <!--    <input type="radio" name="payment_type" value="Knet" id="{{ "knet" . $normal->id }}" >-->
                                <!--    <label for="{{ "knet" . $normal->id }}" class="paytype" style="width: 50%">Pay By Knet</label>-->
                                <!--    <span class="switch3" style="width: 50%"></span>-->
                                <!--</div>-->
                                <input type="hidden" class="form-control" name="payment_type" value="Knet" >
                                <input type="hidden" name="type" value="normal" >
                                <input type="hidden" name="package_id" value="{{ $normal->id }}" >
                                <button type="submit" class="btn" style="width: 50%; background-color:#eaeaea; border:1px solid #088dd3; font-weight:bold; font-family:'open sans' "  >
                                    {{__('buy')}}
                                </button>
                        </form>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<hr>
<div id="static-div" class="d-none">
    <div class="row" >
        @foreach($statics as $static)
            <div class="col-lg-4 col-sm-6 col-md-5 f_left"  style="display: flex;">
                <div class="single-listing-category" style="display:flex;width: 100%">
                    <a style="width: 100%">
                        <i class='bx bx-dollar-circle'></i>
                        {{__('kd_title')}} <strike>{{ $static->old_price }}</strike>
                        <font style="font-size:50px;">{{ $static->price }}</font> /
                        <font style="color:#00d683;">{{ $static->count_day }} {{__('days')}}</font>
                        <div>
                            <p>@if(app()->getLocale()=="en"){{$static->title_en}}@else{{$static->title_ar}}@endif</p>
                        </div>
                        <div style="display: flex;height:200px; align-items: center;">
                            <p>@if(app()->getLocale()=="en"){{$static->description_en}}@else{{$static->description_ar}}@endif</p>
                        </div>


                        <div style="text-align:center;">
                        <form method="post" action="{{ route('Main.buyPackageOrCredit',app()->getLocale()) }}" >
                            @csrf
                                <!--<div class="fieldset2" style="font-size: 12px;width:100%">-->
                                <!--    <input type="radio" name="payment_type" value="Cash" id="{{ "cash" . $static->id }}" checked>-->
                                <!--    <label for="{{ "cash" . $static->id }}" class="paytype" style="width: 50%">Pay By Cash</label>-->
                                <!--    <input type="radio" name="payment_type" value="Knet" id="{{ "knet" . $static->id }}" >-->
                                <!--    <label for="{{ "knet" . $static->id }}" class="paytype" style="width: 50%">Pay By Knet</label>-->
                                <!--    <span class="switch3" style="width: 50%"></span>-->
                                <!--</div>-->
                                <div>
                                    <input type="hidden" class="form-control" name="payment_type" value="Knet" >
                                    <input type="number" min="1" class="form-control" placeholder="{{__('noofads')}}" name="count" id="{{ "static-num-" . $static->id }}" required >
                                </div>
                                <input type="hidden" name="type" value="static" >
                                <input type="hidden" name="package_id" value="{{ $static->id }}" >
                                <br>
                                <button type="submit" class="btn" style="width: 50%; background-color:#eaeaea; border:1px solid #088dd3; font-weight:bold; font-family:'open sans' "  >
                                    {{__('buy')}}
                                </button>
                        </form>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div style="clear:both;"></div>
