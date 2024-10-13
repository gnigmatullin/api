<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Submission::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        Submission::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'submission stored',
            'data' => $validated,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        return $submission->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $submission->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'submission updated',
            'data' => $validated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'submission deleted',
        ]);
    }
}
