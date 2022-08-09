<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $list=  Comment::whereHas("advertising")->with(["advertising.area","advertising.city","user"])->orderBy("id","desc")->paginate(20);
        return view("comments.index",compact('list'));
    }
    public function commentAdvertising($id)
    {
       $list=  Comment::with(["user"])->where('advertising_id',$id)->orderBy("id","desc")->paginate(10);
       return view("comments.index",compact("list"));
    }
    public function comments($commentId)
    {
        Comment::whereId($commentId)->delete();
        return redirect()->back();
    }

}
