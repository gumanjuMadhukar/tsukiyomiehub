<?php

namespace App\Http\Controllers\Backend\Banners;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Banners\AddNewRequest; // Assuming these requests exist and are properly configured
use App\Http\Requests\Backend\Banners\UpdateRequest; // Assuming these requests exist and are properly configured
use Exception;
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
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'page' => 'nullable|string|max:255',
                'section' => 'nullable|string|max:255',
                'status' => 'required|integer|in:0,1',
            ]);

            $banner = new Banner();
            $banner->title = $request->title;
            $banner->description = $request->Description;
            $banner->page = $request->page;
            $banner->section = $request->section;
            $banner->status = $request->status;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/banners'), $imageName);
                $banner->image = $imageName;
            }

            if ($banner->save()) {
                return redirect()->route('banner.index')->with('success', 'Banner created successfully!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
            }
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', $e ?? 'An error occurred. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3064',
                'page' => 'nullable|string|max:255',
                'section' => 'nullable|string|max:255',
                'status' => 'required|integer|in:0,1',
            ]);

            $banner = Banner::findOrFail($id);
            $banner->title = $request->title;
            $banner->description = $request->Description;
            $banner->page = $request->page;
            $banner->section = $request->section;
            $banner->status = $request->status;

            if ($request->hasFile('image')) {
                // Delete old image if it exists

                if ($banner->image) {
                    $oldImagePath = public_path('uploads/banners') . '/' . $banner->image;
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/banners'), $imageName);
                $banner->image = $imageName;
            }

            if ($banner->save()) {
                return redirect()->route('banner.index')->with('success', 'Banner updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);

            // Delete image file if it exists
            if ($banner->image) {
                $imagePath = public_path('uploads/banners') . '/' . $banner->image;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if ($banner->delete()) {
                return redirect()->back()->with('success', 'Banner deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }
}
