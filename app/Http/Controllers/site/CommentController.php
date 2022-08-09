<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store()
    {
//        dd(\request()->all());
        $user=Auth::user();
        $result=$this->filterKeywords(\request('comment'));
        if(!$result[0]){
            return $this->fail("invalid Keyword (".$result[1].")",-1,request()->all());
        }
        $user->comments()->create([
            'comment'=>\request('comment'),
            'advertising_id'=>\request('advertising_id'),
            'comment_id'=>'',
            'status'=>1
        ]);
        return $this->success('success');


    }

    public function get()
    {
        return Comment::where('advertising_id',\request('advertising_id'))->where('status',1)->with(['user'])->get();

    }
}
