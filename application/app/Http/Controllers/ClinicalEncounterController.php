<?php

namespace App\Http\Controllers;

use App\Code;
use App\Patient;
use App\Inventory;
use App\VitalSign;
use App\Medication;
use App\Suppliment;
use App\SupplimentOrder;
use App\ClinicalEncounter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\AddMedicationRequest;
use App\Http\Requests\AddSupplimentRequest;
use App\Http\Requests\ClinicalEncounterRequest;
use App\Immunization;
use App\Vaccine;

class ClinicalEncounterController extends Controller
{
    public function index(Patient $patient_id)
    {
        $clinic_id = session()->get('clinic_id');
        $clinical = ClinicalEncounter::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->first();
        $vital = VitalSign::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->orderBy('id', 'DESC')->first();
        $drugs = Inventory::all();
        $medications = Medication::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->where('encounter_id', null)->orderBy('id', 'DESC')->get();

        $suppliments = Suppliment::all();
        $suppliment_orders = SupplimentOrder::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->where('encounter_id', null)->orderBy('id', 'DESC')->get();

        $medicalProblems = Code::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->where('encounter_id', null)->get();

        $vitalSigns = VitalSign::where('patient_id', $patient_id->id)->where('clinic_id', session()->get('clinic_id'))->orderBy('created_at', 'desc')->get();

         //wait for age chart
        $waightForAge = [];
        $waightForAgeMonth = [];

        foreach($vitalSigns as $vsign){
        array_push($waightForAge, $vsign->wfa);
        }

        foreach($vitalSigns as $vsign){
        array_push($waightForAgeMonth, $vsign->created_at->format('M d'));
        }

        $wfaChart =array_reverse($waightForAge);
        $waightForAgeMonthChart =array_reverse($waightForAgeMonth);

        $wfaCharttoString = implode(",", $wfaChart);
        $monthCharttoString = implode(",", $waightForAgeMonthChart);
        //wait for age chart



        return view('front.clinical-encounter', compact('wfaCharttoString','monthCharttoString','patient_id', 'clinical', 'vital', 'drugs', 'medications', 'medicalProblems', 'suppliments', 'suppliment_orders'));
    }

    public function clinicalEncounterStore(ClinicalEncounterRequest $request)
    {
        $ce_add = ClinicalEncounter::create($request->all());

        if($ce_add) {
            Code::where('patient_id', $ce_add->patient_id)->where('encounter_id', null)->update([
                'encounter_id' => $ce_add->id,
            ]);
            Medication::where('patient_id', $ce_add->patient_id)->where('encounter_id', null)->update([
                'encounter_id' => $ce_add->id,
            ]);
            SupplimentOrder::where('patient_id', $ce_add->patient_id)->where('encounter_id', null)->update([
                'encounter_id' => $ce_add->id,
            ]);
            Session::flash('message', 'Clinical Encounter Successfully Added');

            Toastr::success('', 'Clinical Encounter Successfully Added');

            return redirect()->back()->with('success', 'Clinical Encounter Successfully Added');
        }
        return redirect()->back()->with('error', 'Clinical Encounter Not Added');
    }

    public function clinicalEncounterUpdate(ClinicalEncounterRequest $request, $id)
    {
        $ce_update = ClinicalEncounter::whereId($id)
                                                ->update($request->except('_token'));

        if($ce_update) {
            Session::flash('message', 'Clinical Encounter Successfully Upated');

            Toastr::success('', 'Clinical Encounter Successfully Updated');

            return redirect()->back()->with('success', 'Clinical Encounter Successfully Updated');
        }
        return redirect()->back()->with('error', 'Clinical Encounter Not Updated');
    }

    public function addMedication(AddMedicationRequest $request)
    {
        if(Auth::user()->role != 'doctor') {
            Session::flash('message', 'Sorry your are not allow to this action! Please assign a doctor.');

            Toastr::success('', 'Sorry your are not allow to this action! Please assign a doctor.');

            return redirect()->back()->with('success', 'Sorry your are not allow to this action! Please assign a doctor.');
        }
        $order_qty =  array_sum(explode('-', $request->dosage)) * $request->period;

        $insert = Medication::create([
            'patient_id' => $request->patient_id,
            'clinic_id' => session()->get('clinic_id'),
            'doctor_id' => Auth::id(),
            'drug_id' => $request->drug_id,
            'description' => $request->description,
            'dosage' => $request->dosage,
            'order_qty' => $order_qty,
            'period' => $request->period,
            'dosage_form' => $request->dosage_form,
            'notes' => $request->notes,
        ]);

        if($insert) {
            Session::flash('message', 'Medication Successfully Inserted');

            Toastr::success('', 'Medication Successfully Inserted');

            return redirect()->back()->with('success', 'Medication Successfully Inserted');
        }
        return redirect()->back()->with('error', 'Medication Not Inserted');
    }

    public function addSuppliment(AddSupplimentRequest $request)
    {
        if(Auth::user()->role != 'doctor') {
            Session::flash('message', 'Sorry your are not allow to this action! Please assign a doctor.');

            Toastr::success('', 'Sorry your are not allow to this action! Please assign a doctor.');

            return redirect()->back()->with('success', 'Sorry your are not allow to this action! Please assign a doctor.');
        }
        $order_qty =  $request->per_day_qty * $request->period;

        $insert = SupplimentOrder::create([
            'patient_id' => $request->patient_id,
            'clinic_id' => session()->get('clinic_id'),
            'doctor_id' => Auth::id(),
            'suppliment_id' => $request->suppliment_id,
            'description' => $request->description,
            'per_day_qty' => $request->per_day_qty,
            'order_qty' => $order_qty,
            'period' => $request->period,
            'dosage_form' => $request->dosage_form,
            'notes' => $request->notes,
        ]);

        if($insert) {
            Session::flash('message', 'Suppliment Order Successfully Inserted');

            Toastr::success('', 'Suppliment Order Successfully Inserted');

            return redirect()->back()->with('success', 'Suppliment Order Successfully Inserted');
        }
        return redirect()->back()->with('error', 'Suppliment Order Not Inserted');
    }

   public function storecode($id,Request $request){

        if(auth()->user()->role != 'doctor'){
            return Response::json(['message'=>'Only doctor can add code']);
        }
        $input = $request->all();
        $input['patient_id'] = $id;
        $input['clinic_id'] = session()->get('clinic_id');

        $code = Code::create($input);

        return $code;

    }

    public function getCode($patientId)
    {
        return Code::where('patient_id', $patientId)->where('clinic_id', session()->get('clinic_id'))->where('encounter_id', null)->get();
    }

    public function deletecode(Patient $patient, Code $code)
    {
        if(auth()->user()->role != 'doctor'){
            return Response::json(['message'=>'Only doctor can remove code']);
        }
       return $code->delete();
    }
}
