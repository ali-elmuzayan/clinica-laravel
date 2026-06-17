<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patients = Patient::query();

        if ($request->has('search')) {
            $patients->where('name_ar', 'like', '%'.$request->search.'%')
                ->orWhere('name_en', 'like', '%'.$request->search.'%')
                ->orWhere('age', 'like', '%'.$request->search.'%')
                ->orWhere('gender', 'like', '%'.$request->search.'%')
                ->orWhere('nationality', 'like', '%'.$request->search.'%')
                ->orWhere('birth_date', 'like', '%'.$request->search.'%')
                ->orWhere('address', 'like', '%'.$request->search.'%')
                ->orWhere('phone', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
        }

        $patients = $patients->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'data' => $patients,
            'message' => 'Patients fetched successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $patient = Patient::create($request->all());

        return response()->json([
            'data' => $patient,
            'message' => 'Patient created successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return response()->json([
            'data' => $patient,
            'message' => 'Patient fetched successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->all());

        return response()->json([
            'data' => $patient,
            'message' => 'Patient updated successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'data' => $patient,
            'message' => 'Patient deleted successfully',
            'status' => 'success',
        ]);
    }
}
