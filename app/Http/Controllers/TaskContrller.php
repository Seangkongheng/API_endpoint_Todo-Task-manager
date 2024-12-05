<?php

namespace App\Http\Controllers;

use App\Models\Task\Task;
use Illuminate\Http\Request;

class TaskContrller extends Controller
{
    public function index()
    {

        $objTask= Task::all()->map(function($objTask){
            return [
                'id' =>$objTask->id,
                'title' => $objTask->title,
                'description'=>$objTask->description,
                'date'=>$objTask->date,
                'staff_id' => url('storage/'.$objTask->staff->profile) ,
            ];
        });

        return response()->json($objTask);
    }
    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'date' => 'required'


        ]);

        Task::create(
            [
                'staff_id' => $request->staff_id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'date' => $request->date,

            ]
        );
        return response()->json(["Message" => "Task Add succesfully", 200]);

    }
    public function show($id)
    {
        $objTask = Task::find($id);
        return response()->json($objTask);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'staff_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'date' => 'required'
        ]);

        $objTask = Task::findOrFail($id);
        $objTask->update([
            'staff_id' => $request->staff_id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'date' => $request->date,
        ]);

        // Return a success response
        return response()->json(["message" => "Task updated successfully"], 200);
    }

    public function destroy($id)
    {
        $objTask = Task::findOrFail($id);
        $objTask->delete();
        return response()->json(["message" => "Task delete successfully"], 200);
    }

    public function getStaffTask($staff_id){
        $objTask= Task::where("staff_id",$staff_id)->first();
        return response()->json($objTask);
    }

}
