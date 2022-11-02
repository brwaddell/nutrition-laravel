<?php

namespace App\Http\Controllers\Front;

use App\Patient;
use App\Vaccine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PushVaccineRequest;
use App\Immunization;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class ImmunizationController extends Controller
{
    public function index(Patient $patient_id)
    {
        $vaccines = Vaccine::all();
        return view('front/immunization/index', compact('patient_id', 'vaccines'));
    }

    public function pushVaccine(Patient $patient_id, PushVaccineRequest $request)
    {
        $immune = Immunization::where('patient_id', $patient_id->id)->where('vaccine_id', $request->vaccine_id)->first();
        // return $immune;
        if($immune) {
            $date_count = $immune->date_count + 1;
            $intersect = array_merge($immune->next_date, $request->vaccine_date);

            Immunization::where('patient_id', $patient_id->id)->where('vaccine_id', $request->vaccine_id)->update([
                'next_date' => $intersect,
                'date_count' =>  $date_count,
            ]);
        }
        else {
            Immunization::create([
                'patient_id' => $patient_id->id,
                'vaccine_id' => $request->vaccine_id,
                'clinic_id' => session()->get('clinic_id'),
                'next_date' => $request->vaccine_date,
                'date_count' => 1,
                'status' => 3,
            ]);
        }

        Session::flash('message', 'Dose completed!');

        Toastr::success('', 'Dose completed!');

        return redirect()->back()->with('success', 'Dose completed!');

    }
}
