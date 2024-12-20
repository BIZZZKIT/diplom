<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePremiseRequest;
use App\Models\ImagesPremises;
use App\Models\Premise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiseController extends Controller
{
    public function createPremise(CreatePremiseRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $premise = Premise::create($data);
        if ($request->hasFile('photos')) {
            foreach($request->file('photos') as $image) {
                $fileName = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('premises', $fileName, 'public');
                ImagesPremises::create(['path' => $path, 'premise_id' => $premise->id]);
            }
        }

        return back()->with('successPremiseCreate', 'Помещение создано');
    }

    public function getPremises()
    {
        $premises = Premise::with('images')->get();

        return view('users.catalog',compact('premises'));
    }
}
