<?php

namespace App\Http\Controllers\Front;

use App\CheckIn;
use App\Patient;
use App\Vaccine;
use App\Medication;
use App\Agricultural;
use App\Immunization;
use App\MaternalHealth;
use App\PaternalHistory;
use App\PrenatalHistory;
use App\BirthInformation;
use App\ClinicalEncounter;
use App\PublicHealthForm;
use App\IntermittentHealth;
use App\PublicHealthAnswer;
use App\ParentalInformation;
use Illuminate\Http\Request;
use App\PublicHealthQuestion;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\AddParentRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\AddBirthInforRequest;
use App\Http\Requests\PrenataHistoryRequest;

class PatientController extends Controller
{
    public function store(PatientStoreRequest $request)
    {

        $input = $request->except('image');
        $input['name'] = $request->first_name . ' ' . $request->last_name;

        if (!empty($request->image)) {
           $input['image'] = fileUpload($request['image'], path_patient_image()); // upload file
        }

        Patient::create($input);

        Toastr::success('', 'Patient Successfully Created');

        return redirect()->back()->with('success', 'Patient created successfully');

    }

    public function editPatientChart(Request $request, $id)
    {
        $clinic_id = session()->get('clinic_id');
        $patient = Patient::whereId($id)->first();
        if($request->isMethod('POST')) {
            $patient_update = Patient::whereId($patient->id)
            ->update([
                'first_name' => is_null($request->first_name) ? $patient->first_name : $request->input('first_name'),
                'last_name' => is_null($request->last_name) ? $patient->last_name : $request->input('last_name'),
                'dob' => is_null($request->dob) ? $patient->dob : $request->input('dob'),
                'home_address' => is_null($request->home_address) ? '' : $request->input('home_address'),
                'street' => is_null($request->street) ? '' : $request->input('street'),
                'city' => is_null($request->city) ? '' : $request->input('city'),
                'state' => is_null($request->state) ? '' : $request->input('state'),
                'country' => is_null($request->country) ? '' : $request->input('country'),
                'postal_code' => is_null($request->postal_code) ? '' : $request->input('postal_code'),
            ]);

            if($patient_update) {
                Session::flash('message', 'Patient Successfully Upated');

                Toastr::success('', 'Patient Successfully Updated');

                return redirect()->back()->with('success', 'Patient Successfully Updated');
            }
            return redirect()->back()->with('error', 'Patient Not Updated');

        }
        $parents = ParentalInformation::where('patient_id', $id)->get();
        $prenatal = PrenatalHistory::where('patient_id', $id)->first();
        $birth_info = BirthInformation::where('patient_id', $id)->first();
        $vaccines = Vaccine::orderBy('name', 'asc')->pluck('name', 'id');
        $immunizations = Immunization::where('patient_id', $patient->id)->orderBy('id', 'desc')->with('vaccine')->get();
        $ppp = $patient->id;
        $vacciness = Vaccine::with('immunization')->whereHas('immunization', function($q) use ($ppp) {
            $q->where('patient_id', $ppp);
        })->get();
        $vdc = Immunization::where('patient_id', $patient->id)->max('date_count');
        // return $vdc;
        // return $vaccines;
        $clinical_encounters = ClinicalEncounter::where('patient_id', $patient->id)->with('medical_problems', 'medications', 'suppliments')->orderBy('id', 'desc')->get();
        // return $clinical_encounters;
        return view('front/edit-patient-chart', compact('patient', 'parents', 'prenatal', 'birth_info', 'vaccines', 'immunizations', 'clinical_encounters', 'vacciness', 'vdc'));
    }

    public function add_parent(AddParentRequest $request, $id)
    {
        $add_parent = ParentalInformation::create([
            'patient_id' => $id,
            'parent_type' => $request->parent_type,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'language' => $request->language,
            'racial_identity' => $request->racial_identity,
            'martial_status' => $request->martial_status,
            'cell_phone' => $request->cell_phone,
            'whatsapp' => $request->whatsapp,
            'district' => $request->district,
            'dpi_no' => $request->dpi_no,
            'occupation' => $request->occupation,
            'is_migrant' => $request->migrant,
            'primary_caregiver' => $request->primary_caregiver,
            'caregiver_info' => $request->caregiver_info,
            'clinic_id' => session()->get('clinic_id'),
        ]);

        if($add_parent) {
            Session::flash('message', 'Parent Successfully Added');

            Toastr::success('', 'Parent Successfully Added');

            return redirect()->back()->with('success', 'Parent Successfully Added');
        }
        return redirect()->back()->with('error', 'Parent Not Added');
    }

    public function addPrenatalHistory(PrenataHistoryRequest $request, $id)
    {
        $addPrenatalHistory = PrenatalHistory::create([
            'patient_id' => $id,
            'course' => $request->course,
            'pregnancy_no' => $request->pregnancy_no,
            'high_risk' => $request->high_risk == 'on' ? 1 : 0,
            'abortion' => $request->abortion == 'on' ? 1 : 0,
            'premature_parturition' => $request->premature_parturition == 'on' ? 1 : 0,
            'diagnosis' => $request->diagnosis,
            'clinic_id' => session()->get('clinic_id'),
        ]);

        if($addPrenatalHistory) {
            Session::flash('message', 'Prenatal History Successfully Added');

            Toastr::success('', 'Prenatal History Successfully Added');

            return redirect()->back()->with('success', 'Prenatal History Successfully Added');
        }
        Toastr::error('', 'Prenatal History Not Added');
        return redirect()->back()->with('error', 'Prenatal History Not Added');
    }

    public function editPrenatalHistory(PrenataHistoryRequest $request, $id)
    {
        $prenatal = PrenatalHistory::where('patient_id', $id)->first();
        $prenatalUpdate = PrenatalHistory::whereId($prenatal->id)
                            ->update([
                                'course' => is_null($request->course) ? $prenatal->course : $request->input('course'),
                                'pregnancy_no' => is_null($request->pregnancy_no) ? $prenatal->pregnancy_no : $request->input('pregnancy_no'),
                                'high_risk' => $request->high_risk == 'on' ? 1 : 0,
                                'abortion' => $request->abortion == 'on' ? 1 : 0,
                                'premature_parturition' => $request->premature_parturition == 'on' ? 1 : 0,
                                'diagnosis' => is_null($request->diagnosis) ? $prenatal->diagnosis : $request->input('diagnosis'),
                            ]);

        if($prenatalUpdate) {
            Session::flash('message', 'Prenatal History Successfully Upated');

            Toastr::success('', 'Prenatal History Successfully Updated');

            return redirect()->back()->with('success', 'Prenatal History Successfully Updated');
        }
        return redirect()->back()->with('error', 'Prenatal History Not Updated');
    }

    public function addBirthInformation(AddBirthInforRequest $request, $id)
    {
        $addBirthInfo = BirthInformation::create([
            'patient_id' => $id,
            'birth_weight' =>$request->birth_weight,
            'weight_unit' =>$request->weight_unit,
            'birth_length' =>$request->birth_length,
            'length_unit' =>$request->length_unit,
            'apgars' =>$request->apgars,
            'skin_immediately' => $request->skin_immediately == 'on' ? 1 : 0,
            'breastfeeding' => $request->breastfeeding == 'on' ? 1 : 0,
            'respiratory_distress' => $request->respiratory_distress == 'on' ? 1 : 0,
            'jaundice' => $request->jaundice == 'on' ? 1 : 0,
            'spesis' => $request->spesis == 'on' ? 1 : 0,
            'hospitalization' =>$request->hospitalization,
            'solid_foods' =>$request->solid_foods,
            'fresh_fruits' =>$request->fresh_fruits,
            'clinic_id' => session()->get('clinic_id'),
        ]);

        if($addBirthInfo) {
            Session::flash('message', 'Birth Information Successfully Added');

            Toastr::success('', 'Birth Information Successfully Added');

            return redirect()->back()->with('success', 'Birth Information Successfully Added');
        }
        Toastr::error('', 'Birth Information Not Added');
        return redirect()->back()->with('error', 'Birth Information Not Added');

    }

    public function editBirthInformation(AddBirthInforRequest $request, $id)
    {
        $birth_info = BirthInformation::where('patient_id', $id)->first();

        $birth_info_update = BirthInformation::whereId($birth_info->id)
                            ->update([
                                'birth_weight' => is_null($request->birth_weight) ? $birth_info->birth_weight : $request->input('birth_weight'),
                                'weight_unit' => is_null($request->weight_unit) ? $birth_info->weight_unit : $request->input('weight_unit'),
                                'birth_length' => is_null($request->birth_length) ? $birth_info->birth_length : $request->input('birth_length'),
                                'length_unit' => is_null($request->length_unit) ? $birth_info->length_unit : $request->input('length_unit'),
                                'apgars' => is_null($request->apgars) ? $birth_info->apgars : $request->input('apgars'),
                                'skin_immediately' => $request->skin_immediately == 'on' ? 1 : 0,
                                'breastfeeding' => $request->breastfeeding == 'on' ? 1 : 0,
                                'respiratory_distress' => $request->respiratory_distress == 'on' ? 1 : 0,
                                'jaundice' => $request->jaundice == 'on' ? 1 : 0,
                                'spesis' => $request->spesis == 'on' ? 1 : 0,
                                'hospitalization' => is_null($request->hospitalization) ? $birth_info->hospitalization : $request->input('hospitalization'),
                                'solid_foods' => is_null($request->solid_foods) ? $birth_info->solid_foods : $request->input('solid_foods'),
                                'fresh_fruits' => is_null($request->fresh_fruits) ? $birth_info->fresh_fruits : $request->input('fresh_fruits'),
                            ]);

        if($birth_info_update) {
            Session::flash('message', 'Birth Information Successfully Upated');

            Toastr::success('', 'Birth Information Successfully Updated');

            return redirect()->back()->with('success', 'Birth Information Successfully Updated');
        }
        return redirect()->back()->with('error', 'Birth Information Not Updated');
    }

    public function publicHealthQuestion(Patient $patient_id, Request $request)
    {

        $publicHealthForm = PublicHealthForm::all();
        if(!$request->checkin_id) {
            Session::flash('message', 'Go with proper route!');

            Toastr::success('', 'Go with proper route!');

            return redirect('/')->with('success', 'Go with proper route!');
        }
        CheckIn::whereId($request->checkin_id)->update(['status' => 2]);
        $checkin_id = $request->checkin_id;
        $intermittentHealth = IntermittentHealth::where('patient_id', $patient_id->id)->where('clinic_id', session()->get('clinic_id'))->first();
        $clinic_id = session()->get('clinic_id');
        $maternal_health = MaternalHealth::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->first();
        $agricultural = Agricultural::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->first();
        $paternal = PaternalHistory::where('clinic_id', $clinic_id)->where('patient_id', $patient_id->id)->first();

        $IntermittentHealthForm = PublicHealthForm::findOrFail(1);
        $maternaltHealthForm = PublicHealthForm::findOrFail(2);
        $parentalHealthForm = PublicHealthForm::findOrFail(3);
        $agriculturalForm = PublicHealthForm::findOrFail(4);

        $test = $IntermittentHealthForm->questions;
        $test2 = $maternaltHealthForm->questions;
        $test3 = $parentalHealthForm->questions;
        $test4 = $agriculturalForm->questions;

        $i = [];
        foreach($test as $t){
            foreach($t->answershow as $answer){
                if($answer->patient_id == $patient_id->id){
                    array_push($i, $answer->answer) ;
                }
            }

        }


        $i2 = [];
        foreach($test2 as $t){
            foreach($t->answershow as $answer){
                if($answer->patient_id == $patient_id->id){
                    array_push($i2, $answer->answer) ;
                }
            }
        }

        $i3 = [];
        foreach($test3 as $t){
            foreach($t->answershow as $answer){
                if($answer->patient_id == $patient_id->id){
                    array_push($i3, $answer->answer) ;
                }
            }
        }

        $i4 = [];
        foreach($test4 as $t){
            foreach($t->answershow as $answer){
                if($answer->patient_id == $patient_id->id){
                    array_push($i4, $answer->answer) ;
                }
            }
        }

       $publicHealthAnswer = PublicHealthAnswer::where('patient_id', $patient_id->id)->where('form_id', 1)->with('question')->get();
       $maternalHealthAnswer = PublicHealthAnswer::where('patient_id', $patient_id->id)->where('form_id', 2)->with('question')->get();
       $parentalHealthAnswer = PublicHealthAnswer::where('patient_id', $patient_id->id)->where('form_id', 3)->with('question')->get();
       $argiculturalAnswer = PublicHealthAnswer::where('patient_id', $patient_id->id)->where('form_id', 4)->with('question')->get();

        return view('front.public-health-question', compact('agriculturalForm','argiculturalAnswer','parentalHealthAnswer','parentalHealthForm','maternalHealthAnswer','maternaltHealthForm','publicHealthAnswer','i', 'i2','i3','i4','publicHealthForm', 'patient_id', 'maternal_health', 'intermittentHealth', 'agricultural', 'paternal', 'checkin_id'));

    }

    public function delete(Patient $patient)
    {
        removeImage(path_patient_image(), $patient->image);

        $patient->delete();

        Session::flash('message', 'Patient Deleted Successfully');

        Toastr::success('', 'Patient Deleted Successfully');

        return redirect()->route('home')->with('success', 'Patient Deleted Successfully');
    }

    public function checkout(Request $request)
    {
        $clinic_id = session()->get('clinic_id');
        if($request->patient_id && $request->checkin_id) {
            if(isCEComplete($request->patient_id) != 1) {
                Session::flash('message', 'Doctor do not examine this patient. Please do correct way!');

                Toastr::success('', 'Doctor do not examine this patient. Please do correct way!');

                return redirect()->back()->with('success','Doctor do not examine this patient. Please do correct way!');
            }
            if(!Medication::where('patient_id', $request->patient_id)->where('clinic_id', $clinic_id)->where('status', 0)->exists()) {
                CheckIn::whereId($request->checkin_id)->update(['status' => 3]);

                Session::flash('message', 'Patient Successfully Checked Out!');

                Toastr::success('', 'Patient Successfully Checked Out!');

                return redirect()->back()->with('success','Patient Successfully Checked Out!');
            }
            else {
                Session::flash('message', 'Sorry, some orders are pending. Please, Check the orders!');

                Toastr::success('', 'Sorry, some orders are pending. Please, Check the orders!');

                return redirect()->back()->with('success','Sorry, some orders are pending. Please, Check the orders!');
            }
        }
        else {
            Session::flash('message', 'Server does not find this patient!');

            Toastr::success('', 'Server does not find this patient!');

            return redirect()->back()->with('success', 'Server does not find this patient!');
        }
    }

    public function imageupdate(Patient $patient, Request $request)
    {
        $input = [];

        if ($request->has('image')) {
            if (!empty($request->image)) {
                $old_img = '';
                $file = Patient::where('id', $patient->id)->first();
                $old_img = isset($file) ? $file->image : '';

                $input['image'] = fileUpload($request['image'], path_patient_image(), $old_img); // upload file
            }
        }

        $patient->update([
            'image'=>$input['image'],
        ]);
    }

    public function searchPatientGlobally(Request $request)
    {
        $patient = Patient::where('name', 'like', '%' . $request->name . '%')->get();
        return $patient;
    }
}
