<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Regions;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getRegions($districtId)
    {
        $regions = Regions::where('district_id', $districtId)->get();
        return response()->json($regions);
    }

    public function getCities($regionId)
    {
        $cities = Cities::where('region_id', $regionId)->get();
        return response()->json($cities);
    }
}
