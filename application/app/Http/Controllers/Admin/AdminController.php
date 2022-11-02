<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Patient;
use App\Medication;
use App\ClinicalEncounter;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\PharmasistDataTable;
use App\DataTables\MedicalAssistantDataTable;
use App\Suppliment;

class AdminController extends Controller
{
    public function index(AdminDataTable $dataTable, DoctorDataTable $doctorTable, MedicalAssistantDataTable $nurseTable, PharmasistDataTable $pharmasistTable, $roles)
    {
        if($roles == 'admins') {
            $user = User::where('role', 'admin')->get();
            return $dataTable->render('users.index', compact('user'));
        }
        elseif($roles == 'doctors') {
            $user = User::where('role', 'doctor')->get();
            return $doctorTable->render('users.index', compact('user'));
        }
        elseif($roles == 'medical-assistants') {
            $user = User::where('role', 'medical assistant')->get();
            return $nurseTable->render('users.index', compact('user'));
        }
        else {
            $user = User::where('role', 'pharmacist')->get();
            return $pharmasistTable->render('users.index', compact('user'));
        }

    }

    public function dashboard()
    {
        $patientCount = Patient::count();
        $pharmacistCount = User::where('role', 'pharmacist')->count();
        $medicalAssistantCount = User::where('role', 'medical assistant')->count();
        $numberofclinicalencounterCount = ClinicalEncounter::count();
        $medicineCount = Medication::count();
        $supplimentsCount = Suppliment::count();

        return view('admin.dashboard.dashboard', compact('patientCount', 'pharmacistCount', 'medicalAssistantCount', 'numberofclinicalencounterCount', 'medicineCount', 'supplimentsCount'));
    }

    public function create()
    {
        return view('users.edit');
    }
}
