<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Advertising;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'body'=>"required"
        ])->validate();

        $service = new Service();
        $service->title = $request->title ;
        $service->body = $request->body ;

        if ($request->main_image != "") {
            $p = str_replace(env("APP_URL"), "", $request->main_image);
        } else {
            $p = "/images/main/panel/noimage.png" ;
        }
        $service->image = $p ;

        if ($service->save()) {
            return redirect('/admin/services#result' )->with(['status' => 'success']);
        } else {
            return redirect('/admin/services#result' )->with(['status' => 'unsuccess']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
//     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('site.pages.service' , compact('service')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
//     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit' , compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
//     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $service = Service::find($request->serviceid);
        $service->title = $request->title ;
        $service->body = $request->body ;

        if ($request->main_image != "") {
            $p = str_replace(env("APP_URL"), "", $request->main_image);
            $service->image = $p ;
        }
        else {
            $service->image = "/images/main/panel/noimage.png" ;
        }


        if ($service->save()) {
            return redirect('/admin/services#result' )->with(['status' => 'successedit']);
        } else {
            return redirect('/admin/services#result' )->with(['status' => 'unsuccessedit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
//     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->back();
    }
}
