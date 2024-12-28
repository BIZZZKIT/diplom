<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePremiseRequest;
use App\Models\Cities;
use App\Models\FederalDistricts;
use App\Models\ImagesPremises;
use App\Models\Premise;
use App\Models\Regions;
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

    public function getPremises(Request $request)
    {
        $premises = Premise::with('images')->get();
        $cities = Cities::orderBy('name', 'asc')->pluck('name', 'id');
        $regions = Regions::orderBy('name', 'asc')->pluck('name','id');
        $federalDistricts = FederalDistricts::orderBy('name', 'asc')->pluck('name', 'id');

        return view('users.catalog', compact('premises', 'cities', 'regions', 'federalDistricts'));
    }

}
