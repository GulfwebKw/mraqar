<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyPushy;
use App\Models\Notification;
use App\Models\NotificationMessage;
use App\User;
use Illuminate\Http\Request;
class NotificationController extends Controller
{

    public function index(Request $requesr)
    {
        $list=Notification::with("user")->orderBy('id','desc')->paginate(30);
        return view("notifications.index",compact("list"));
    }
    public function createForm(Request $request)
    {
        $allUser=User::where('type','member')->count();
        $allCompanyUser=User::where('type','member')->where('type_usage','company')->count();
        $allIndividualUser=User::where('type','member')->where('type_usage','individual')->count();
        $noCommentUser=User::where('type','member')->whereDoesntHave("comments")->count();
        $noBookingUser=User::where('type','member')->whereDoesntHave("bocking")->count();
        $noPayed=User::where('type','member')->whereDoesntHave("payments",function ($r){
            $r->where('package_id','!=',18)->where('status','completed');
        })->count();
        $potentialCustomers=User::where('type','member')->whereHas("payments",function ($r){
            $r->where('package_id','!=',18)->where('status','canceled')->orWhere('status','failed');
        })->count();

        return view("notifications.create",compact('allUser','allCompanyUser','allIndividualUser','noCommentUser','noBookingUser','noPayed','potentialCustomers'));
    }


    public function create(Request $request)
    {
        dispatch(new NotifyPushy($request->title_en,$request->title_ar,$request->message_en,$request->message_ar,$request->type))->afterResponse();
       $success=true;

        $allUser=User::where('type','member')->count();
        $allCompanyUser=User::where('type','member')->where('type_usage','company')->count();
        $allIndividualUser=User::where('type','member')->where('type_usage','individual')->count();
        $noCommentUser=User::where('type','member')->whereDoesntHave("comments")->count();
        $noBookingUser=User::where('type','member')->whereDoesntHave("bocking")->count();
        $noPayed=User::where('type','member')->whereDoesntHave("payments",function ($r){
            $r->where('package_id','!=',18)->where('status','completed');
        })->count();
        $potentialCustomers=User::where('type','member')->whereHas("payments",function ($r){
            $r->where('package_id','!=',18)->where('status','canceled')->orWhere('status','failed');
        })->count();

        return view("notifications.create",compact('success','allUser','allCompanyUser','allIndividualUser','noCommentUser','noBookingUser','noPayed','potentialCustomers'));
    }


  public function updateSettings(Request $request)
    {

       // dd($request->all());
        $list=NotificationMessage::all()->keyBy('key');
        foreach ($list as $key=>$item) {
            $item->title_en=$request->{$key."_title_en"};
            $item->title_ar=$request->{$key."_title_ar"};
            $item->message_ar=$request->{$key."_message_ar"};
            $item->message_en=$request->{$key."_message_en"};
            $item->save();

        }


       $success=true;
        $notification_message=NotificationMessage::all()->keyBy('key');

        return view("notifications.settings",compact('notification_message','success'));
    }

    public function delete($id)
    {
        Notification::whereId($id)->delete();
        return redirect()->back();
    }

    public function settings()
    {
        $notification_message=NotificationMessage::all()->keyBy('key');
        return view("notifications.settings",compact('notification_message'));

    }

}