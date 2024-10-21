<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query();
        return DataTables::of($users)
            ->addColumn('action', function ($users) {

                $showBtn =  '<button ' .
                    ' class="btn btn-outline-info" ' .
                    ' onclick="showUsers(' . $users->id . ')">Show' .
                    '</button> ';

                $editBtn =  '<button ' .
                    ' class="btn btn-outline-success" ' .
                    ' onclick="editUsers(' . $users->id . ')">Edit' .
                    '</button> ';

                $deleteBtn =  '<button ' .
                    ' class="btn btn-outline-danger" ' .
                    ' onclick="destroyUsers(' . $users->id . ')">Delete' .
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
            'email' => 'required|email',
            // 'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(123456),
        ]);

        return response()->json(['status' => "success"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            // 'password' => 'required',
        ]);

        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['status' => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
