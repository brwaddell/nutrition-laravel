<?php

namespace App\Http\Controllers\Admin;

use App\Clinic;
use Illuminate\Http\Request;
use App\DataTables\ClinicDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class ClinicController extends Controller
{
    public function index(ClinicDatatable $dataTable)
    {
        $clinic = Clinic::all();

        return $dataTable->render('admin.clinic.index', compact('clinic'));
    }

    public function create(){
        return view('admin.clinic.create');
    }

    public function store(ClinicRequest $request)
    {

        Clinic::create($request->all());

        Session::flash('message', 'Successfully created');

        Toastr::success('message', 'Successfully Created');

        return redirect(route('clinic.index'))->with('success', 'Clinic created successfully');
    }

    public function show(Clinic $clinic)
    {
       return view('admin.clinic.create', compact('clinic'));
    }

    public function update(Clinic $clinic, ClinicRequest $request)
    {
        $clinic->update($request->all());

        session()->flash('success', 'Successfully updated');

        Toastr::success('success', 'Successfully updated', ["positionClass" => "toast-top-right"]);

        return back();

    }


    public function delete(Clinic $clinic)
    {
        $clinic->delete();

        session()->flash('success', 'Successfully Deleted');

        Toastr::success('success', 'Successfully Deleted', ["positionClass" => "toast-top-right"]);

        return back();
    }
}
