<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisingLikeController extends Controller
{
    public function store()
    {
        $user=Auth::user();
        $user->advertisingLikes()->sync([\request('advertising_id')]);
        return $this->success('success');
    }

    public function destroy()
    {
        $user=Auth::user();
        $user->advertisingLikes()->detach([\request('advertising_id')]);
        return $this->success('success');
    }
}
