@php
    $facebook  = App\Http\Controllers\site\MessageController::getSettingDetails('facebook');
    $twitter   = App\Http\Controllers\site\MessageController::getSettingDetails('twitter');
    $instagram = App\Http\Controllers\site\MessageController::getSettingDetails('instagram');
    $snapchat  = App\Http\Controllers\site\MessageController::getSettingDetails('snapchat');
    $youtube   = App\Http\Controllers\site\MessageController::getSettingDetails('youtube');
    $whatsapp  = App\Http\Controllers\site\MessageController::getSettingDetails('whatsapp');

    if (auth()->check()) {
        $balance = cache()->remember('balance_values', 300, function() {
            return \App\Http\Controllers\site\MainController::getBalance();
        });
    } else
        $balance = 0;
@endphp
@include('site.layout.header')

@yield('content')

@include('site.layout.footer')
