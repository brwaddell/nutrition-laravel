<?php

namespace App\Http\Controllers\Admin;

use App\Patient;
use Illuminate\Http\Request;
use App\DataTables\PatientDatatable;
use App\Http\Controllers\Controller;

class PatientsController extends Controller
{
    public function index(PatientDatatable $dataTable)
    {
        $user = Patient::all();
        return $dataTable->render('admin.patient.index', compact('user'));
    }
}
