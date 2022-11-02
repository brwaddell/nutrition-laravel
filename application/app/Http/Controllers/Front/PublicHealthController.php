<?php

namespace App\Http\Controllers\Front;

use App\Agricultural;
use App\IntermittentHealth;
use App\MaternalHealth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgriculturalRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\IntermittentHealthRequest;
use App\Http\Requests\MaternalHealthRequest;
use App\Http\Requests\PaternalHistoryRequest;
use App\PaternalHistory;

class PublicHealthController extends Controller
{
    public function intermittenthealth(IntermittentHealthRequest $request)
    {
       $intermittenthealthinfo = IntermittentHealth::create([
            'clinic_id'=>$request->clinic_id,
            'patient_id'=>$request->patient_id,
            'diarrhealasttwoweeks'=>$request->diarrhealasttwoweeks,
            'stoolswithbloodormucus'=>$request->stoolswithbloodormucus,
            'morethanthreediarrhealstoolorliquid'=>$request->morethanthreediarrhealstoolorliquid,
            'toiletmorethantimesthanusual'=>$request->toiletmorethantimesthanusual,
            'acutegastrointestinalinfection'=>$request->acutegastrointestinalinfection,
            'anyofthefollowinglasttwoweeks'=>$request->anyofthefollowinglasttwoweeks,
            'hadstoolswithbloodormucus'=>$request->hadstoolswithbloodormucus,
            'diarrhealast'=>$request->diarrhealast,
            'cough' => $request->cough == 'on' ? 1 : 0,
            'resipiratorydistrees' => $request->resipiratorydistrees == 'on' ? 1 : 0,
            'intercostalretractions' => $request->intercostalretractions == 'on' ? 1 : 0,
            'fever' => $request->fever == 'on' ? 1 : 0,
            'fastorrapidbreathing' => $request->fastorrapidbreathing == 'on' ? 1 : 0,
            'greenoryellowmucous' => $request->greenoryellowmucous == 'on' ? 1 : 0,
            'hospitalizationinthelasttwoweeks' => $request->hospitalizationinthelasttwoweeks == 'on' ? 1 : 0,
            'numberofdayshospitalized' => $request->numberofdayshospitalized,
            'none' => $request->none == 'on' ? 1 : 0,
            'reflux' => $request->reflux == 'on' ? 1 : 0,
            'diarrhea' => $request->diarrhea == 'on' ? 1 : 0,
            'abdominalpain' => $request->abdominalpain == 'on' ? 1 : 0,
            'rash' => $request->rash == 'on' ? 1 : 0,
            'glassitis' => $request->glassitis == 'on' ? 1 : 0,
            'difficulytyswallowing' => $request->difficulytyswallowing == 'on' ? 1 : 0,
            'anyantihistaminicorsteroid' => $request->anyantihistaminicorsteroid == 'on' ? 1 : 0,
        ]);

        if($intermittenthealthinfo) {
            Session::flash('message', 'Intermittent Health Information Successfully Added');

            Toastr::success('', 'Intermittent Health Information Successfully Added');

            return redirect()->back()->with('success', 'Intermittent Health Information Successfully Added');
        }

        Toastr::error('', 'Birth Information Not Added');

        return redirect()->back()->with('error', 'Intermittent Health Information Not Added');

    }


    public function intermittenthealthupdate(IntermittentHealthRequest $request, $id){

        $intermittentHealth = IntermittentHealth::findOrFail($id);
        $intermittenthealthinfo = $intermittentHealth->update([
            'clinic_id'=>$request->clinic_id,
            'patient_id'=>$request->patient_id,
            'diarrhealasttwoweeks'=>$request->diarrhealasttwoweeks,
            'stoolswithbloodormucus'=>$request->stoolswithbloodormucus,
            'morethanthreediarrhealstoolorliquid'=>$request->morethanthreediarrhealstoolorliquid,
            'toiletmorethantimesthanusual'=>$request->toiletmorethantimesthanusual,
            'acutegastrointestinalinfection'=>$request->acutegastrointestinalinfection,
            'anyofthefollowinglasttwoweeks'=>$request->anyofthefollowinglasttwoweeks,
            'hadstoolswithbloodormucus'=>$request->hadstoolswithbloodormucus,
            'diarrhealast'=>$request->diarrhealast,
            'cough' => $request->cough == 'on' ? 1 : 0,
            'resipiratorydistrees' => $request->resipiratorydistrees == 'on' ? 1 : 0,
            'intercostalretractions' => $request->intercostalretractions == 'on' ? 1 : 0,
            'fever' => $request->fever == 'on' ? 1 : 0,
            'fastorrapidbreathing' => $request->fastorrapidbreathing == 'on' ? 1 : 0,
            'greenoryellowmucous' => $request->greenoryellowmucous == 'on' ? 1 : 0,
            'hospitalizationinthelasttwoweeks' => $request->hospitalizationinthelasttwoweeks == 'on' ? 1 : 0,
            'numberofdayshospitalized' => $request->numberofdayshospitalized,
            'none' => $request->none == 'on' ? 1 : 0,
            'reflux' => $request->reflux == 'on' ? 1 : 0,
            'diarrhea' => $request->diarrhea == 'on' ? 1 : 0,
            'abdominalpain' => $request->abdominalpain == 'on' ? 1 : 0,
            'rash' => $request->rash == 'on' ? 1 : 0,
            'glassitis' => $request->glassitis == 'on' ? 1 : 0,
            'difficulytyswallowing' => $request->difficulytyswallowing == 'on' ? 1 : 0,
            'anyantihistaminicorsteroid' => $request->anyantihistaminicorsteroid == 'on' ? 1 : 0,
        ]);

        if($intermittenthealthinfo) {

            Session::flash('message', 'Intermittent Health Information Successfully updated');

            Toastr::success('', 'Intermittent Health Information Successfully updated');

            return redirect()->back()->with('success', 'Intermittent Health Information Successfully updated');
        }

        Toastr::error('', 'Birth Information Not updated');

        return redirect()->back()->with('error', 'Intermittent Health Information Not updated');
    }

    public function maternalHealthStore(MaternalHealthRequest $request)
    {
        $maternal_health_add = MaternalHealth::create($request->all());

        if($maternal_health_add) {
            Session::flash('message', 'Maternal Health Successfully Added');

            Toastr::success('', 'Maternal Health Successfully Added');

            return redirect()->back()->with('success', 'Maternal Health Successfully Added');
        }
        return redirect()->back()->with('error', 'Maternal Health Not Added');
    }

    public function maternalHealthUpdate(MaternalHealthRequest $request, $id)
    {
        $maternal_health_update = MaternalHealth::whereId($id)
                                                ->update($request->except('_token'));

        if($maternal_health_update) {
            Session::flash('message', 'Maternal Health Successfully Upated');

            Toastr::success('', 'Maternal Health Successfully Updated');

            return redirect()->back()->with('success', 'Maternal Health Successfully Updated');
        }
        return redirect()->back()->with('error', 'Maternal Health Not Updated');
    }

    public function agriculturalStore(AgriculturalRequest $request)
    {
        $agricultural_add = Agricultural::create($request->all());

        if($agricultural_add) {
            Session::flash('message', 'Agricultural Information Successfully Added');

            Toastr::success('', 'Agricultural Information Successfully Added');

            return redirect()->back()->with('success', 'Agricultural Information Successfully Added');
        }
        return redirect()->back()->with('error', 'Agricultural Information Successfully Added');
    }

    public function agriculturalUpdate(AgriculturalRequest $request, $id)
    {
        $agricultural_update = Agricultural::whereId($id)
                                                ->update($request->except('_token'));

        if($agricultural_update) {
            Session::flash('message', 'Agricultural Information Successfully Upated');

            Toastr::success('', 'Agricultural Information Successfully Updated');

            return redirect()->back()->with('success', 'Agricultural Information Successfully Updated');
        }
        return redirect()->back()->with('error', 'Agricultural Information Not Updated');
    }

    public function paternalHistoryStore(PaternalHistoryRequest $request)
    {
        $paternal_history_add = PaternalHistory::create($request->all());

        if($paternal_history_add) {
            Session::flash('message', 'Paternal History Successfully Added');

            Toastr::success('', 'Paternal History Successfully Added');

            return redirect()->back()->with('success', 'Paternal History Successfully Added');
        }
        return redirect()->back()->with('error', 'Paternal History Successfully Added');
    }

    public function paternalHistoryUpdate(PaternalHistoryRequest $request, $id)
    {
        $paternal_history_update = PaternalHistory::whereId($id)
                                                ->update($request->except('_token'));

        if($paternal_history_update) {
            Session::flash('message', 'Paternal History Successfully Upated');

            Toastr::success('', 'Paternal History Successfully Updated');

            return redirect()->back()->with('success', 'Paternal History Successfully Updated');
        }
        return redirect()->back()->with('error', 'Paternal History Not Updated');
    }
}
