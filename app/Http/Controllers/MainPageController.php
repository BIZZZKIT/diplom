<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\FederalDistricts;
use App\Models\News;
use App\Models\Regions;
use App\Models\Reviews;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function getDataForMainPage(){
        $news = News::limit(9)->get();
        $cities = Cities::orderBy('name', 'asc')->pluck('name', 'id');
        $regions = Regions::orderBy('name', 'asc')->pluck('name', 'id');
        $federalDistricts = FederalDistricts::orderBy('name', 'asc')->pluck('name', 'id');
        $reviews = Reviews::with('user')->limit(12)->get();

        return view('welcome', compact('news', 'cities', 'regions', 'federalDistricts', 'reviews'));
    }


}
