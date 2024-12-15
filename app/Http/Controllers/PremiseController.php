<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePremiseRequest;
use App\Models\Premise;
use Illuminate\Http\Request;

class PremiseController extends Controller
{
    public function createPremise(CreatePremiseRequest $request)
    {
        Premise::create($request->validated());
        return back()->with('successPremiseCreate', 'Помещение создано');
    }
}
