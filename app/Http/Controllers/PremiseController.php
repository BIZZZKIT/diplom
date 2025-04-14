<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePremiseRequest;
use App\Models\Cities;
use App\Models\FederalDistricts;
use App\Models\ImagesPremises;
use App\Models\Premise;
use App\Models\PremisePanorama;
use App\Models\Regions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiseController extends Controller
{
    public function createPremise(CreatePremiseRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // Создаем помещение
        $premise = Premise::create($data);

        // Обработка основных фотографий
        if ($request->hasFile('photos')) {
            foreach($request->file('photos') as $image) {
                $fileName = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('premises', $fileName, 'public');
                ImagesPremises::create([
                    'path' => $path,
                    'premise_id' => $premise->id
                ]);
            }
        }

        // Обработка панорам
        if ($request->has('panoramas')) {
            foreach ($request->panoramas as $panorama) {
                if (isset($panorama['photo']) && $panorama['photo']->isValid()) {
                    $fileName = 'panorama-' . time() . '-' . $panorama['photo']->getClientOriginalName();
                    $path = $panorama['photo']->storeAs('premises/panoramas', $fileName, 'public');

                    PremisePanorama::create([
                        'path' => $path,
                        'premise_id' => $premise->id,
                        'room_name' => $panorama['room_name']
                    ]);
                }
            }
        }

        return back()->with('successPremiseCreate', 'Помещение успешно создано');
    }

    public function getPremises(Request $request)
    {
        $premises = Premise::with('images')->get();
        $cities = Cities::orderBy('name', 'asc')->pluck('name', 'id');
        $regions = Regions::orderBy('name', 'asc')->pluck('name', 'id');
        $federalDistricts = FederalDistricts::orderBy('name', 'asc')->pluck('name', 'id');

        return view('catalog', compact('premises', 'cities', 'regions', 'federalDistricts'));
    }

    public function filterPremises(Request $request)
    {
        $query = Premise::query();

        if ($request->filled('type')) {
            $query->where('typeOfSell', $request->type);
        }

        if ($request->filled('category')) {
            $query->where('flatOrHouse', $request->category);
        }

        if ($request->filled('count_room')) {
            $query->where('count_room', $request->count_room);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('federalDistrictsFil')) {
            $query->where('district_id', $request->federalDistrictsFil);
        }

        if ($request->filled('regionsFil')) {
            $query->where('region_id', $request->regionsFil);
        }

        if ($request->filled('citiesFil')) {
            $query->where('city_id', $request->citiesFil);
        }

        $premises = $query->with('images')->get();
        $cities = Cities::orderBy('name', 'asc')->pluck('name', 'id');
        $regions = Regions::orderBy('name', 'asc')->pluck('name', 'id');
        $federalDistricts = FederalDistricts::orderBy('name', 'asc')->pluck('name', 'id');

        return view('catalog', compact('premises', 'cities', 'regions', 'federalDistricts'));
    }




    public function getPremiseItem($premiseId)
    {
        $premise = Premise::with('images', 'federalDistricts', 'regions', 'cities', 'user', 'panoramas')->findOrFail($premiseId);
        return view('users.premisePage', compact('premise'));
    }

    public function getYoursPremises()
    {
        $user_id = Auth::id();

        $yourPremises = Premise::where('user_id', $user_id)->get();
        $cities = Cities::orderBy('name', 'asc')->pluck('name', 'id');
        $regions = Regions::orderBy('name', 'asc')->pluck('name','id');
        $federalDistricts = FederalDistricts::orderBy('name', 'asc')->pluck('name', 'id');
        return view('users.yourPremises', compact('yourPremises','cities', 'regions', 'federalDistricts'));
    }

    public function deleteYourPremise($premiseId)
    {
        $user_id = Auth::id();

        Premise::where('id', $premiseId)->where('user_id', $user_id)->delete();
        ImagesPremises::where('premise_id', $premiseId)->delete();
        return back()->with(['successDeleteYourPremise' => 'Ваше помещение удалено из каталога']);
    }

    public function editYourPremise(Request $request,$premiseId)
    {
        $validData = $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,jpg,png|max:5120',
            'price' => ['required', 'numeric', 'min:1'],
            'count_room' => ['required', 'integer', 'min:1'],
            'square' => ['required', 'numeric', 'min:1'],
            'typeOfSell' => ['required', 'in:Аренда,Продажа'],
            'district_id' => ['required', 'exists:federal_districts,id'],
            'region_id' => ['required', 'exists:regions,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'flatOrHouse' => ['required', 'in:Квартира,Дом'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $premise = Premise::findOrFail($premiseId);

        ImagesPremises::where('premise_id', $premiseId)->delete();

        $premise->update($validData);
        if ($request->hasFile('photos')) {
            foreach($request->file('photos') as $image) {
                $fileName = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('premises', $fileName, 'public');
                ImagesPremises::create(['path' => $path, 'premise_id' => $premiseId]);
            }
        }
        return back()->with(['successEditYourPremise' => 'Ваше объявление успешно изменено']);
    }

}
