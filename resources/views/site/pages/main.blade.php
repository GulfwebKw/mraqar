@extends('site.layout.master')

@section('content')

    <main>
        <div class="px-3">
            <div class="theme-container">
                <div class="mt-5"></div>
                <div class="row">
                    <div class="col-md-12 p-0" style="border: solid 1px lightgray;">
                        <div class="border p-2">
                            <div class="d-flex">
                                <div class="">
                                    <img src="https://placehold.jp/150x150.png" alt="">
                                </div>
                                <div class="mr-3">
                                    <h2>الیجار شقه فی السلام</h2>
                                    <p>600 دینار</p>
                                    <p>قبل 3 ایام</p>
                                    <p>23</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-drawer-container mt-3 row">
                    <div class="" style="width: 100%">
                        <a href="#" class="h-0"></a>
                        <div class="mdc-card">
                            <form action="javascript:void(0);" id="filters" class="search-wrapper m-0 o-hidden">
                                <div class="column p-2">
                                    <div class="col-xs-12 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">Property Type</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                            <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                                <ul class="mdc-list">
                                                    <li class="mdc-list-item mdc-list-item--selected" data-value=""></li>
                                                    <li class="mdc-list-item" data-value="1">Office</li>
                                                    <li class="mdc-list-item" data-value="2">House</li>
                                                    <li class="mdc-list-item" data-value="3">Apartment</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 p-2">
                                        <div class="mdc-select mdc-select--outlined">
                                            <div class="mdc-select__anchor">
                                                <i class="mdc-select__dropdown-icon"></i>
                                                <div class="mdc-select__selected-text"></div>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label class="mdc-floating-label">Property Status</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                            <div class="mdc-select__menu mdc-menu mdc-menu-surface">
                                                <ul class="mdc-list">
                                                    <li class="mdc-list-item mdc-list-item--selected" data-value=""></li>
                                                    <li class="mdc-list-item" data-value="1">For Sale</li>
                                                    <li class="mdc-list-item" data-value="2">For Rent</li>
                                                    <li class="mdc-list-item" data-value="3">Open House</li>
                                                    <li class="mdc-list-item" data-value="4">No Fees</li>
                                                    <li class="mdc-list-item" data-value="5">Hot Offer</li>
                                                    <li class="mdc-list-item" data-value="6">Sold</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="container">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1">radio 1</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">radio 2</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">radio 3</label>
                                    </div>
                                </div>
                                <div class="row around-xs middle-xs p-2 mb-3">
                                    <button class="mdc-button mdc-button--raised" type="submit">
                                        <span class="mdc-button__ripple"></span>
                                        <i class="material-icons mdc-button__icon">search</i>
                                        <span class="mdc-button__label">Search</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="">
                        <div class="properties-wrapper row mt-0">
                            <div class="row item col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <div class="mdc-card property-item grid-item column-3">
                                    <div class="thumbnail-section">
                                        <div class="row property-status">
                                            <span class="green">For Sale</span>
                                        </div>
                                        <div class="property-image">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <img src="assets/images/others/transparent-bg.png" alt="slide image" data-src="assets/images/props/flat-1/1-medium.jpg" class="slide-item swiper-lazy">
                                                        <div class="swiper-lazy-preloader"></div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <img src="assets/images/others/transparent-bg.png" alt="slide image" data-src="assets/images/props/flat-1/2-medium.jpg" class="slide-item swiper-lazy">
                                                        <div class="swiper-lazy-preloader"></div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <img src="assets/images/others/transparent-bg.png" alt="slide image" data-src="assets/images/props/flat-1/3-medium.jpg" class="slide-item swiper-lazy">
                                                        <div class="swiper-lazy-preloader"></div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <img src="assets/images/others/transparent-bg.png" alt="slide image" data-src="assets/images/props/flat-1/4-medium.jpg" class="slide-item swiper-lazy">
                                                        <div class="swiper-lazy-preloader"></div>
                                                    </div>
                                                </div>
                                                <div class="swiper-pagination white"></div>
                                                <button class="mdc-icon-button swiper-button-prev swipe-arrow"><i class="material-icons mat-icon-lg">keyboard_arrow_left</i></button>
                                                <button class="mdc-icon-button swiper-button-next swipe-arrow"><i class="material-icons mat-icon-lg">keyboard_arrow_right</i></button>
                                            </div>
                                        </div>
                                        <div class="control-icons">
                                            <button class="mdc-button add-to-favorite" title="Add To Favorite">
                                                <i class="material-icons mat-icon-sm">favorite_border</i>
                                            </button>
                                            <button class="mdc-button" title="Add To Compare">
                                                <i class="material-icons mat-icon-sm">compare_arrows</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="property-content-wrapper">
                                        <div class="property-content">
                                            <div class="content">
                                                <h1 class="title"><a href="#">Modern and quirky flat</a></h1>
                                                <p class="row address flex-nowrap">
                                                    <i class="material-icons text-muted">location_on</i>
                                                    <span>611 W 180th St, New York, NY 10033, USA</span>
                                                </p>
                                                <div class="row between-xs middle-xs">
                                                    <h3 class="primary-color price">
                                                        <span>$ 1,300,000</span>
                                                    </h3>
                                                    <div class="row start-xs middle-xs ratings" title="29">
                                                        <i class="material-icons mat-icon-sm">star</i>
                                                        <i class="material-icons mat-icon-sm">star</i>
                                                        <i class="material-icons mat-icon-sm">star</i>
                                                        <i class="material-icons mat-icon-sm">star</i>
                                                        <i class="material-icons mat-icon-sm">star_half</i>
                                                    </div>
                                                </div>
                                                <div class="d-none d-md-flex d-lg-flex d-xl-flex">
                                                    <div class="description mt-3">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat modi dignissimos blanditiis accusamus, magni provident omnis perferendis laudantium illo recusandae ab molestiae repudiandae cum obcaecati nulla adipisci fuga culpa repellat!</p>
                                                    </div>
                                                </div>
                                                <div class="features mt-3">
                                                    <p><span>Property size</span><span>2380 ft²</span></p>
                                                    <p><span>Bedrooms</span><span>2</span></p>
                                                    <p><span>Bathrooms</span><span>2</span></p>
                                                    <p><span>Garages</span><span>1</span></p>
                                                </div>
                                            </div>
                                            <div class="grow"></div>
                                            <div class="actions row between-xs middle-xs">
                                                <p class="row date mb-0">
                                                    <i class="material-icons text-muted">date_range</i>
                                                    <span class="mx-2">12 August, 2012</span>
                                                </p>
                                                <a href="javascript:void(0);" class="mdc-button mdc-button--outlined">
                                                    <span class="mdc-button__ripple"></span>
                                                    <span class="mdc-button__label">Details</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
