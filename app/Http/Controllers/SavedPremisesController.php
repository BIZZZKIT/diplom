<?php

namespace App\Http\Controllers;

use App\Models\Premise;
use App\Models\SavedPremises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedPremisesController extends Controller
{
    public function createSavedPremises(Request $request, $premiseId)
    {
        $user = Auth::user();

        if(SavedPremises::where('user_id', $user->id)->where('premise_id', $premiseId)->exists()){
            return back()->with(['savedPremiseExist' => 'Это помещение уже создано']);
        }

        SavedPremises::create([
            'user_id' => $user->id,
            'premise_id' => $premiseId
        ]);

        return back()->with(['savedPremiseCreated' => 'Помещение успешно сохранено']);
    }

    public function getSavedPremise()
    {
        $user = Auth::user();

        $savedPremises = SavedPremises::where('user_id', $user->id)->with('premise', 'premise.images')->get();

        return view('users.savedPremises', compact('savedPremises'));
    }

    public function deleteSavedPremise($premiseId)
    {
        $user = Auth::user();

        SavedPremises::where('premise_id', $premiseId)->where('user_id', $user->id)->delete();

        return back()->with(['successDestroySaved' => 'Помещение успешно удалено']);
    }
}
