<?php

namespace App\Services;

use App\Models\Interaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InteractionService
{
    public function getAllInteractions()
    {
        $interactions = Interaction::where('user_id', '!=', Auth::id())->get();
        return $this->returning(true, 'Interactions Found Successfully', $interactions, 200);
    }

    public function getUserInteractions($id)
    {
        $interactions = Interaction::where('id', $id)->get();
        if ($interactions->isEmpty()) {
            return $this->returning(false, 'There are no interactions for this User', null, 404);
        }
        return $this->returning(true, 'Interactions Found Successfully', $interactions, 200);
    }
    public function insertNewInteraction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'date' => 'required|date',
            'details' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) {
            return $this->returning(false, 'Validation Error', $validator->errors(), 422);
        }
        $interaction = Interaction::create($request->all());
    }


    public function updateInteraction(Request $request, $id)
    {
        $interaction = Interaction::find($id);
        if (!$interaction) {
            return $this->returning(false, 'Interaction Not Found', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'details' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return $this->returning(false, 'Validation Error', $validator->errors(), 422);
        }

        $interaction->update($request->all());
        return $this->returning(true, 'Interaction Updated Successfully', $interaction, 200);
    }

    public function deleteInteraction($id)
    {
        $interaction = Interaction::find($id);
        if (!$interaction) {
            return $this->returning(false, 'Interaction Not Found', null, 404);
        }

        $interaction->delete();
        return $this->returning(true, 'Interaction Deleted Successfully', null, 200);
    }

    public function returning($success, $message, $data, $statusCode)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
