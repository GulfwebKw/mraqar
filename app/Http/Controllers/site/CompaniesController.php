<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\CompanyRequest;
use App\Models\Social;
use App\User;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = User::where('type_usage', 'company')
            ->with('socials')
            ->get();

        return view('site.pages.companies', compact('companies'));
    }

    public function new()
    {
        return view('site.pages.new-company');
    }

    public function store(CompanyRequest $request)
    {
        if($request->file('image')){
            $file= $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('company_images'), $filename);
            $image = $filename;
        }

        $user_id = auth()->id();

        User::where('id', $user_id)->update([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'type_usage' => 'company',
            // 'image_profile' => isset($image) ? $image : '', // todo site: and maybe delete users last image.
        ]);

        $this->insertSocials($request, $user_id);

        return redirect()->route('Main.buyPackage', app()->getLocale()); //todo site: where alert success create company.
    }

    private function insertSocials($request, $user_id)
    {
        $socials = [];
        if ($request->filled('instagram')) {
            $socials [] = [
                'user_id' => $user_id,
                'address' => $request->instagram,
                'type' => 'instagram',
            ];
        }

        if ($request->filled('twitter')) {
            $socials [] = [
                'user_id' => $user_id,
                'address' => $request->twitter,
                'type' => 'twitter',
            ];
        }

        if (!empty($socials)) {
            Social::insert([[
                'user_id' => $user_id,
                'address' => $request->twitter,
                'type' => 'twitter',
            ], [
                'user_id' => $user_id,
                'address' => $request->instagram,
                'type' => 'instagram',
            ]]);
        }
    }
}