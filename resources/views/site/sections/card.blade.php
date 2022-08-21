<card v-for="cards in card" inline-template>
    <div class="col-xs-12 rounded-sm b-gray p-0">
        <div class="border p-2 bg-blue"> {{-- premium:blue --}}
            <div class="row">
                <div class="p-relative col-sm-2 w-sm1/5 p-0 p{{$side}}-2">
                    <img class="w-100 m{{$side}}-2 rounded-xs" src="https://placehold.jp/150x150.png" alt="">
                    <div class="row property-status p-absolute top-0"> {{-- premium:badge --}}
                        <span class="red badge-sm">hot</span>
                    </div>
                </div>
                <div class="col-sm-10 w-sm4/5 p-0">
                    <h2 class="text-lg mb-2">الیجار شقه فی السلام</h2>

                    <div class="flex-container mb-2">
                        <span class="primary-color fw-600 d-inline-block m{{$side}}-2">600 {{__('kd_title')}}</span>
                        <span class="flex flex-container m{{$side}}-2">
                                            <i class="material-icons mat-icon-sm text-muted m{{$side}}-1 mb-1">calendar_month</i>
                                            <span class="text-sm">3 days ago</span>
                                            {{-- <p>قبل 3 ایام</p> --}}
                                        </span>
                        <span class="flex flex-container">
                                            <i class="material-icons-outlined mat-icon-sm text-muted m{{$side}}-1">visibility</i>
                                            <span class="text-sm">23</span>
                                        </span>
                    </div>

                    <div class="d-none d-sm-block d-md-block d-lg-more-block mb-2 fw-600 {{-- premium:fw-600 --}}">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
                    </div>

                    <a href="javascript:void(0);" class="mdc-button mdc-button--outlined small-button d-none sm-show-button">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label fw-600">Rent</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 p-0 d-sm-none d-md-none d-lg-more-none fw-600 {{-- premium:fw-600 --}}">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
                </div>
            </div>
        </div>
    </div>
</card>
