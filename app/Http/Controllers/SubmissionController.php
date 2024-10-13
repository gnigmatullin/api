<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Submission;
use App\Jobs\SaveSubmission;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validation errors occurred',
                'errors' => $validator->errors()
            ], 422);
        }

        SaveSubmission::dispatch($validator->validate());
        return response()->json([
            'status' => 'success',
            'message' => 'save submission job added to queue',
            'data' => $validator->validate(),
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validation errors occurred',
                'errors' => $validator->errors()
            ]);
        }

        $submission->update($validator->validate());
        return response()->json([
            'status' => 'success',
            'message' => 'submission updated',
            'data' => $validator->validate(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        if ($submission->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'submission deleted',
            ]);
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => 'error on submission delete'
            ]);
        }
    }
}
