<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\CheckIn;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AddCheckedInRequest;

class ClinicalsController extends Controller
{
    public function index()
    {
        $checked_ins = CheckIn::where('clinic_id', session()->get('clinic_id'))->where('status','!=', 3)->orderBy('id', 'DESC')->with('patient', 'doctor')->paginate(10);
        $doctors = User::where('role', 'doctor')->get();
        return view('front.clinicals', compact('checked_ins', 'doctors'));
    }

    public function checkin($patientId)
    {
        $patientId = Patient::where('id', $patientId)->first();
        $checked_ins = CheckIn::orderBy('status', 'DESC')->where('status','!=', 3)->with('patient', 'doctor')->paginate(5);
        $doctors = User::where('role', 'doctor')->get();
        return view('front.clinicals', compact('checked_ins', 'doctors', 'patientId'));
    }

    public function searchbyname(Request $request)
    {
        if($request->name == []){
            return false;
        }else{
            return Patient::where('clinic_id', Session::get('clinic_id'))->where(function($query) use($request){
                $query->where('name', 'like', '%'.$request->name.'%');
            })->get();
        }
    }

    public function addToCheckedIn(Request $request)
    {
        $action = CheckIn::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'clinic_id' => session()->get('clinic_id'),
            'reason' => $request->reason,
            'room_no' => $request->room_no,
        ]);

        if($action) {
            Session::flash('message', 'Patient Successfully Checked In');

            Toastr::success('', 'Patient Successfully Checked In');

            return redirect()->back()->with('success', 'Patient Successfully Checked In');
        }
        return redirect()->back()->with('error', 'Patient Not Checked In');
    }

    public function destroy($id)
    {
        $clinical = CheckIn::where('id', $id)->firstorFail();

        $clinical->delete();

        Session::flash('message', 'Patient Clinical Deleted Successfully');

        Toastr::success('', 'Patient Clinical Deleted Successfully');

        return redirect()->back()->with('success', 'Patient Clinical Deleted Successfully');
    }
}
