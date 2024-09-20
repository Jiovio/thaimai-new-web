<?php

namespace App\Http\Controllers;

use App\Models\Ecregister;
use Illuminate\Http\Request;

class EcregisterController extends Controller
{
    public function index()
    {
        return Ecregister::all();
    }

    public function show($id)
{
    $ecregister = Ecregister::find($id);

    if ($ecregister) {
        return response()->json($ecregister, 200);
    } else {
        return response()->json(['message' => 'Record not found'], 404);
    }
}

public function store(Request $request)
    {
        // Validate the incoming request data
       $validatedData = $request->validate([
            'ecfrno' => 'required|string|max:20',
            'dateecreg' => 'required|string|max:50',
            'picmeNo' => 'required|string|max:20',
            'motheraadhaarid' => 'required|string|max:30',
            'motheraadhaarname' => 'required|string|max:100',
            'husbandaadhaarid' => 'required|string|max:30',
            'husbandaadhaarname' => 'required|string|max:100',
            'motherfullname' => 'required|string|max:100',
            'motherdob' => 'required|string|max:50',
            'motherageecreg' => 'required|string|max:11',
            'motheragemarriage' => 'required|string|max:11',
            'mothermobno' => 'required|string|max:20',
            'mobileofperson' => 'required|string|max:60',
            'motheredustatus' => 'required|string|max:80',
            'husfullname' => 'required|string|max:100',
            'husdob' => 'required|string|max:50',
            'husageecreg' => 'required|string|max:11',
            'husagemarriage' => 'required|string|max:11',
            'husmobno' => 'required|string|max:20',
            'husedustatus' => 'required|string|max:80',
            'religion' => 'required|string|max:50',
            'caste' => 'required|string|max:50',
            'BlockId' => 'required|string|max:70',
            'PhcId' => 'required|string|max:100',
            'HscId' => 'required|string|max:10',
            'PanchayatId' => 'required|string|max:10',
            'VillageId' => 'required|string|max:10',
            'address' => 'required|string|max:300',
            'pincode' => 'nullable|string|max:11',
            'povertystatus' => 'required|string|max:50',
            'migrantstatus' => 'required|string|max:100',
            'rationcardtype' => 'required|string|max:40',
            'rationcardnum' => 'required|string|max:20', 
            'status' => '1'
        ]);

        // Create a new record in the database
        $ecregister = Ecregister::create($validatedData);

       // $ecregister = Ecregister::create($request->all());

        // Return a response with a success message and the created resource
        return response()->json([
            'message' => 'Record created successfully',
            'data' => $ecregister
        ], 201);
    }



public function update(Request $request, $id)
{
    $ecregister = Ecregister::find($id);

    if ($ecregister) {
        $ecregister->update($request->all());
        return response()->json(['message' => 'Record updated successfully', 'data' => $ecregister], 200);
    } else {
        return response()->json(['message' => 'Record not found'], 404);
    }
}

    public function destroy($id)
{
    $ecregister = Ecregister::find($id);

    if ($ecregister) {
        $ecregister->delete();
        return response()->json(['message' => 'Record deleted successfully'], 200);
    } else {
        return response()->json(['message' => 'Record not found'], 404);
    }
}
}
