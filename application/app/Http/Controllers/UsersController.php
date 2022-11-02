<?php

namespace App\Http\Controllers;

use App\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserCreateRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        $user = User::all();
        return $dataTable->render('users.index', compact('user'));
    }

    public function create(){
        return view('users.edit');
    }

    public function store(UserCreateRequest $request)
    {
        $input = $request->except('image');
        if($input['role'] == 'doctor') {
            $input['name'] = 'Dr. '. $input['name'];
        }
        $input['password'] = Hash::make($input['password']);

        if (!empty($request->image)) {
           $input['image'] = fileUpload($request['image'], path_user_image()); // upload file
        }

       $user = User::create($input);


        Session::flash('message', 'Successfully created');

        Toastr::success('message', 'Successfully Created');

        if($user->role == 'admin') {
            return redirect(route('users.admins.index', 'admins'))->with('success', 'User created successfully');
        }
        elseif($user->role == 'medical assistant') {
            return redirect(route('users.admins.index', 'medical-assistants'))->with('success', 'User created successfully');
        }
        elseif($user->role == 'doctor') {
            return redirect(route('users.admins.index', 'doctors'))->with('success', 'User created successfully');
        }
        else {
            return redirect(route('users.admins.index', 'pharmasists'))->with('success', 'User created successfully');
        }
        
    }

    public function show(User $user)
    {
       return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $input = $request->except('image');
        $input['password'] = Hash::make($input['password']);

        if ($request->has('image')) {
            if (!empty($request->image)) {
                $old_img = '';
                $file = User::where('id', $user->id)->first();
                $old_img = isset($file) ? $file->image : '';

                $input['image'] = fileUpload($request['image'], path_user_image(), $old_img); // upload file
            }
        }

        $user->update($input);

        session()->flash('success', 'Successfully updated');

        Toastr::success('success', 'Successfully updated', ["positionClass" => "toast-top-right"]);

        return back();

    }


    public function delete(User $user)
    {

        removeImage(path_user_image(), $user->image);

        $user->delete();

        session()->flash('success', 'Successfully Deleted');

        Toastr::success('success', 'Successfully Deleted', ["positionClass" => "toast-top-right"]);

        return back();
    }
}
