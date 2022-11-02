<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Clinic;
use App\Patient;
use Carbon\Carbon;
use App\ClinicalEncounter;
use App\ParentalInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\ChangePasswordRequest;


class DashboardController extends Controller
{
    public function index()
    {
        $clinic_id = session()->get('clinic_id');
        $patientCount = Patient::where('clinic_id', $clinic_id)->with('clinic')->count();
        $clinicalEncounterCount = ClinicalEncounter::where('clinic_id', $clinic_id)->count();
        $patients = Patient::where('clinic_id', $clinic_id)->with('clinic')->paginate(10);

        $todaysAddedPatients = Patient::where('clinic_id', $clinic_id)->whereDate('created_at', Carbon::today())->count();

        return view('front.dashboard', compact('patients','patientCount','todaysAddedPatients', 'clinicalEncounterCount'));

    }

    public function sessionClinic($id)
    {
        $clinic  = Clinic::find($id);

        session()->put('clinic_id', $clinic->id);
        session()->put('clinic_name', $clinic->name);
        return response(['msg' => 'Success', 'user'=>Auth::user()]);

    }

    public function profileShow()
    {
        $user = User::where('id', Auth::id())->first();
        return view('front.profile', compact('user'));
    }

    public function profileUpdate(UserUpdateRequest $request)
    {
        $user_update = User::whereId(Auth::id())->update($request->except('_token'));

        if($user_update) {
            Session::flash('message', 'User Successfully Upated');

            Toastr::success('', 'User Successfully Updated');

            return redirect()->back()->with('success', 'User Successfully Updated');
        }
        return redirect()->back()->with('error', 'User Not Updated');
    }

    public function imageupdate(User $user, Request $request)
    {
        $input = [];

        if ($request->has('image')) {
            if (!empty($request->image)) {
                $old_img = '';
                $file = Patient::where('id', $user->id)->first();
                $old_img = isset($file) ? $file->image : '';

                $input['image'] = fileUpload($request['image'], path_user_image(), $old_img); // upload file
            }
        }

        $user->update([
            'image'=>$input['image'],
        ]);
    }

    public function settings()
    {
        return view('front/settings');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('id', Auth::id())->first();

        if(Hash::check($request->password, $user->password)) {
            $password_update = User::whereId($user->id)->update(['password' => Hash::make($request->npassword)]);

            if($password_update) {

                Session::flash('message', 'Password changed!');

                Toastr::success('', 'Password changed!');

                return redirect()->route('logout')->with('success', 'Password changed!');
            }

        }
        else {
            Session::flash('message', 'Password does not matched!');

            Toastr::success('', 'Password does not matched!');

            return redirect()->back()->with('success', 'Password does not matched!');
        }


    }

    public function language($lang)
    {
        $language = $lang ?? 'en';
        session(['selected_language' =>$language]);

        return redirect()->route('home');
    }

}
