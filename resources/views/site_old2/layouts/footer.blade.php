<footer class="footer-area">
    <div class="container">
        <div class="footer-bottom-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    @if (app()->getLocale()=='en')
                        <p>Copyright <i class='bx bx-copyright'></i>{{date('Y')}} <a href="#" target="_blank">Ajrnii</a> | All rights reserved.</p>
                    @else
                        <p>حقوق النشر <i class="bx bx-copyright"></i>{{date('Y')}} <a href="#" target="_blank">اجرني</a> | كل الحقوق محفوظة.</p>
                    @endif
                </div>
                @php
                $facebook  = App\Http\Controllers\site\MessageController::getSettingDetails('facebook');
                $twitter   = App\Http\Controllers\site\MessageController::getSettingDetails('twitter');
                $instagram = App\Http\Controllers\site\MessageController::getSettingDetails('instagram');
                $snapchat  = App\Http\Controllers\site\MessageController::getSettingDetails('snapchat');
                $youtube   = App\Http\Controllers\site\MessageController::getSettingDetails('youtube');
                $whatsapp  = App\Http\Controllers\site\MessageController::getSettingDetails('whatsapp');

                @endphp
                <div class="col-lg-6 col-md-6 single-footer-widget">
                    <ul class="social-link">
                        @if($facebook)
                        <li><a href="{{$facebook}}" class="d-block" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                        @endif
                        @if($twitter)
                        <li><a href="{{$twitter}}" class="d-block" target="_blank"><i class='bx bxl-twitter'></i></a></li>
                        @endif
                        @if($instagram)
                        <li><a href="{{$instagram}}" class="d-block" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                        @endif
                        @if($snapchat)
                        <li><a href="{{$snapchat}}" class="d-block" target="_blank"><i class='bx bxl-snapchat'></i></a></li>
                        @endif
                        @if($youtube)
                        <li><a href="{{$youtube}}" class="d-block" target="_blank"><i class='bx bxl-youtube'></i></a></li>
                        @endif
                         @if($whatsapp)
                        <li><a href="tel:{{$whatsapp}}" class="d-block" target="_blank"><i class='bx bxl-whatsapp'></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->

<div class="go-top"><i class='bx bx-chevron-up'></i></div>
