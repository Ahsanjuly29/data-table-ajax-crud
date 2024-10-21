<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::query();
        return DataTables::of($projects)
            ->addColumn('action', function ($project) {

                $showBtn =  '<button ' .
                    ' class="btn btn-outline-info" ' .
                    ' onclick="showProject(' . $project->id . ')">Show' .
                    '</button> ';

                $editBtn =  '<button ' .
                    ' class="btn btn-outline-success" ' .
                    ' onclick="editProject(' . $project->id . ')">Edit' .
                    '</button> ';

                $deleteBtn =  '<button ' .
                    ' class="btn btn-outline-danger" ' .
                    ' onclick="destroyProject(' . $project->id . ')">Delete' .
                    '</button> ';

                return $showBtn . $editBtn . $deleteBtn;
            })
            ->rawColumns(
                [
                    'action',
                ]
            )
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        return response()->json(['status' => "success"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        return response()->json(['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        return response()->json(['status' => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
