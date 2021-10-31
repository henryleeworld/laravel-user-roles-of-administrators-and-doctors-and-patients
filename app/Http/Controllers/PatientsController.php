<?php

namespace App\Http\Controllers;

use App\Models\User;

class PatientsController extends Controller
{
    public function __invoke()
    {
        $patients = User::patientFields()->where('role_id', User::ROLE_PATIENT)->paginate(100);

        return view('patients.index', compact('patients'));
    }
}