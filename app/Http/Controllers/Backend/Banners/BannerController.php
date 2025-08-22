<?php

namespace App\Http\Controllers\Backend\Banners;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Banners\AddNewRequest;
use App\Http\Requests\Backend\Banners\UpdateRequest;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Hash;
use File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::paginate();
        return view('backend.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::get();
        return view('backend.banner.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewRequest $request)
    {
        try {
            $banner = new Banner();
            $banner->name_en = $request->fullName_en;
            $banner->name_bn = $request->fullName_bn;
            $banner->contact_en = $request->contactNumber_en;
            $banner->contact_bn = $request->contactNumber_bn;
            $banner->email = $request->emailAddress;
            $banner->role_id = $request->roleId;
            $banner->date_of_birth = $request->birthDate;
            $banner->gender = $request->gender;
            $banner->status = $request->status;
            $banner->password = Hash::make($request->password);
            $banner->language = 'en';
            $banner->access_block = $request->accessBlock;

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/Banners'), $imageName);
                $banner->image = $imageName;
            }
            if ($banner->save())
                return redirect()->route('banner.index')->with('success', 'Data Saved');
            else
                return redirect()->back()->withInput()->with('error', 'Please try again');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::get();
        $banner = Banner::findOrFail(encryptor('decrypt', $id));

        return view('backend.banner.edit', compact('role', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {

            $banner = Banner::findOrFail(encryptor('decrypt', $id));
            $banner->name_en = $request->fullName_en;
            $banner->name_bn = $request->fullName_bn;
            $banner->contact_en = $request->contactNumber_en;
            $banner->contact_bn = $request->contactNumber_bn;
            $banner->email = $request->emailAddress;
            $banner->role_id = $request->roleId;
            $banner->date_of_birth = $request->birthDate;
            $banner->gender = $request->gender;
            $banner->status = $request->status;
            $banner->password = Hash::make($request->password);
            $banner->language = 'en';
            $banner->access_block = $request->accessBlock;

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/Banners'), $imageName);
                $banner->image = $imageName;
            }
            if ($banner->save())
                return redirect()->route('banner.index')->with('success', 'Data Saved');
            else
                return redirect()->back()->withInput()->with('error', 'Please try again');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Banner::findOrFail(encryptor('decrypt', $id));
        $image_path = public_path('uploads/Banners') . $data->image;

        if ($data->delete()) {
            if (File::exists($image_path))
                File::delete($image_path);

            return redirect()->back();
        }
    }
}
