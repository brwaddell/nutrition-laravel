<?php

namespace App\Http\Controllers\Admin;

use App\Vaccine;
use Illuminate\Http\Request;
use App\DataTables\VaccineDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VaccineRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class VaccineController extends Controller
{
    public function index(VaccineDataTable $dataTable)
    {
        $vaccines = Vaccine::all();
        return $dataTable->render('admin.vaccine.index', compact('vaccines'));
    }

    public function create()
    {
        return view('admin.vaccine.create');
    }

    public function store(VaccineRequest $request)
    {

        Vaccine::create($request->all());

        Session::flash('message', 'Successfully created');

        Toastr::success('message', 'Successfully Created');

        return redirect(route('vaccine.index'))->with('success', 'Vaccine created successfully');
    }

    public function show(Vaccine $vaccine)
    {
       return view('admin.vaccine.create', compact('vaccine'));
    }

    public function update(Vaccine $vaccine, VaccineRequest $request)
    {
        $vaccine->update($request->all());

        session()->flash('success', 'Successfully updated');

        Toastr::success('success', 'Successfully updated', ["positionClass" => "toast-top-right"]);

        return back();

    }

    public function delete(Vaccine $vaccine)
    {
        $vaccine->delete();

        session()->flash('success', 'Successfully Deleted');

        Toastr::success('success', 'Successfully Deleted', ["positionClass" => "toast-top-right"]);

        return back();
    }
}
