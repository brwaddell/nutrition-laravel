<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function create()
    {
        $site = Site::first();
        return view('admin.site.create', compact('site'));
    }

    public function store(SiteRequest $request)
    {

        $input = $request->except('image1', 'image2', 'image3');

        if (!empty($request->image1)) {
           $input['image1'] = fileUpload($request['image1'], path_site_logo_image()); // upload file
        }

        if (!empty($request->image2)) {
            $input['image2'] = fileUpload($request['image2'], path_site_favicon_image()); // upload file
        }

        if (!empty($request->image3)) {
            $input['image3'] = fileUpload($request['image3'], path_site_white_image()); // upload file
        }

        Site::create($input);

        Session::flash('message', 'Successfully created');

        Toastr::success('message', 'Successfully Created');

        return redirect()->back()->with('success', 'Site created successfully');
    }

    public function update(SiteRequest $request, $id)
    {

        $site = Site::FindOrFail($id);

        $input = $request->except('image1', 'image2','image3');

        if (!empty($request->image1)) {
            $old_img = '';
            $file = Site::where('id', $id)->first();
            $old_img = isset($file) ? $file->image1 : '';

            $input['image1'] = fileUpload($request['image1'], path_site_logo_image(), $old_img); // upload file
        }
        if (!empty($request->image2)) {
            $old_img = '';
            $file = Site::where('id', $id)->first();
            $old_img = isset($file) ? $file->image2 : '';

            $input['image2'] = fileUpload($request['image2'], path_site_favicon_image(), $old_img); // upload file
        }
        if (!empty($request->image3)) {
            $old_img = '';
            $file = Site::where('id', $id)->first();
            $old_img = isset($file) ? $file->image3 : '';

            $input['image3'] = fileUpload($request['image3'], path_site_favicon_image(), $old_img); // upload file
        }


        $site->update($input);

        Session::flash('message', 'Successfully created');

        Toastr::success('message', 'Successfully Updated');

        return redirect()->back()->with('success', 'Site updated successfully');
    }
}
