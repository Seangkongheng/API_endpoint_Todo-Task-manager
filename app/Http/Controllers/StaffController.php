<?php

namespace App\Http\Controllers;

use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $objstaff = Staff::all()->map(function($objStaff){
            return [
                'id' => $objStaff->id,
                'first_name'=>$objStaff->first_name,
                'last_name'=>$objStaff->last_name,
                'profile' => url('storage/' . $objStaff->profile),
                'position_id' => $objStaff->position->title,
            ];
        });


        return response()->json($objstaff);
    }

    public function store(Request $request)
    {
        // Validation for the incoming request
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender_id' => 'required',
            'position_id' => 'required',
            'profile' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Handle the file upload and store the profile picture
        $profilePath = $request->file('profile')->store('profiles', 'public');

        // Create a new staff record with the validated data
        $objStaff = Staff::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender_id' => $request->gender_id,
            'position_id' => $request->position_id,
            'profile' => $profilePath,
        ]);

        return response()->json(["Message" => "Staff added successfully"], 200);
    }

    public function show($staff_id)
    {
        // Find the staff member by ID
        $objstaff = Staff::find($staff_id);

        if ($objstaff) {
            return [
                'id' => $objstaff->id,
                'first_name'=>$objstaff->first_name,
                'last_name'=>$objstaff->last_name,
                'profile' => url(path: 'storage/' . $objstaff->profile),
                'position_id' => $objstaff->position->title,
            ];
           
        } else {
            return response()->json(["message" => "Staff not found"], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Validation for the incoming request
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender_id' => 'required',
            'position_id' => 'required',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Find the staff record by ID
        $objStaff = Staff::findOrFail($id);

        // Check if a profile image was uploaded and store it
        if ($request->hasFile('profile')) {
            // Delete the old profile image from storage if it exists
            if ($objStaff->profile && Storage::disk('public')->exists($objStaff->profile)) {
                Storage::disk('public')->delete($objStaff->profile);
            }

            // Store the new profile image
            $profilePath = $request->file('profile')->store('profiles', 'public');
            $objStaff->profile = $profilePath;
        }

        // Update the staff record with the validated data
        $objStaff->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender_id' => $request->gender_id,
            'position_id' => $request->position_id,
        ]);

        return response()->json(["message" => "Staff updated successfully"], 200);
    }

    public function destroy($id)
    {
        // Find the staff record by ID
        $objStaff = Staff::findOrFail($id);

        // Check if the staff member has a profile image and delete it from storage
        if ($objStaff->profile && Storage::disk('public')->exists($objStaff->profile)) {
            Storage::disk('public')->delete($objStaff->profile);
        }

        // Delete the staff record from the database
        $objStaff->delete();

        return response()->json(["message" => "Staff deleted successfully"], 200);
    }
}
