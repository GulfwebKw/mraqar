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
        $user = auth()->user();
        $user_id = $user->id;

        if ($request->file('image')) {
            $file= $request->file('image');
            $filename = date('Y_m_d_').$file->getClientOriginalName();
            $file->move(public_path('company_images'), $filename);
        }

        if ($user->image_profile && file_exists($path = public_path('old_users_images_directory_path'). '/' . $user->image_profile))
            unlink($path); // todo site: old user images directory


        User::where('id', $user_id)->update([
            'company_name' => $request->company_name,
            'company_phone' => $request->company_phone,
            'image_profile' => isset($filename) ? $filename : '',
            'type_usage' => 'company',
        ]);

        $this->insertSocials($request, $user_id);
        return redirect()->route('Main.buyPackage', app()->getLocale())->withInput()->with('status', 'account_upgraded');
    }

    private function insertSocials($request, $user_id)
    {
        $socials = [];
        if ($request->filled('email')) {
            $socials [] = [
                'user_id' => $user_id,
                'address' => $request->instagram,
                'type' => 'email',
            ];
        }

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
