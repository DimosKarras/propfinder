<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/municipalities/{path_id}', function ($pathId){

    $municipality = \App\Models\Municipality::query()->where('path_id', $pathId)->first();

    if(is_null($municipality)){
        return response()->json(['success' => false, 'status' => '404' ,'message' => 'Municipality not found'], '404');
    }

    $realEstate = \App\Models\RealEstate::query()
        ->where('municipality_id', $municipality->id)
        ->where('year', 2023)
        ->first();
    $population = \App\Models\Population::query()
        ->where('municipality_id', $municipality->id)
        ->where('year', 2021)
        ->first();

    return response()->json(['success' => true, 'data' => [
        'municipality' => $municipality->name,
        'sector' => $municipality->sector,
        'area' => $municipality->density,
        'price' => number_format($realEstate->apartment_price, 3),
        'population' => number_format($population->men + $population->women)
    ]]);
});

Route::post('/sustainability-results/{path_id}', function (Request $request, $pathId) {

    // take the weights
    $formData = $request->input('formData');
    $formData = json_decode($formData, true);

    $municipality = \App\Models\Municipality::query()->where('path_id', $pathId)->first();
    if(is_null($municipality)){
        return response()->json(['success' => false, 'status' => '404' ,'message' => 'Municipality not found'], '404');
    }

    $indexes = [
        'population',
        'criminality',
        'pollution',
        'preSchool',
        'primarySchool',
        'middleSchool',
        'highSchool',
        'vocationalHighSchool',
        'schoolLaboratoryCenter',
        'subway',
        'taxi',
        'stops',
        'stopsDisability',
        'coolingArea',
        'heatingArea',
        'elderly',
        'rehab',
        'kdap',
        'kdapDisability',
        'realEstate'
    ];

    $request->validate([
        'formData' => 'required|json',
    ]);

    $formData = json_decode($request->formData, true);

    $validator = Validator::make(['formData' => $formData], [
        'formData.*' => function ($attribute, $value, $fail) use ($indexes) {
            $key = explode('.', $attribute)[1]; // Get the key from the attribute
            if (!in_array($key, $indexes)) {
                $fail($attribute.' is invalid.');
            }
            if (!is_numeric($value) || $value < 0 || $value > 1) {
                $fail($attribute.' value must be between 0 and 1.');
            }
        },
    ]);

    // Check for validation failure
    if ($validator->fails()) {
        return response()->json([
            'success' => 'false',
            'status' => '422',
            'errors' => $validator->errors()
        ], 422); // HTTP status code 422 indicates unprocessable entity
    }

    $finalIndex = 0;
    $realEstateIndex = 0;
    $flag = 0;
    $arrayIndex = [];
    $arrayFinal = [];
    $arrayTitles = config('draft.trans');

    foreach($formData as $key => $value){
        switch ($key) {
            case 'pollution':
                $pollution = new \App\Models\Pollution();
                $tempIndex = $pollution->calculateIndex($municipality->id);
                if(is_null($tempIndex)){
                    break;
                }
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'criminality':
                $criminality = new \App\Models\Criminality();
                $tempIndex = $criminality->calculateIndex(2019);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'realEstate':
                $realEstate = \App\Models\RealEstate::query()
                    ->where('municipality_id', $municipality->id)
                    ->where('year', 2023)
                    ->first();
                $tempIndex = $realEstate->calculateIndex();
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $realEstateIndex = $tempIndex*$value;
                $tempIndex = null;
                break;
            case 'population':
                $population = \App\Models\Population::query()
                    ->where('municipality_id', $municipality->id)
                    ->where('year', 2021)
                    ->first();
                $tempIndex = $population->calculateIndex($municipality->density);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'preSchool':
                $schools = new \App\Models\School();
                $tempIndex = $schools->calculateIndex('Νηπιαγωγεία', $pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'primarySchool':
                $schools = new \App\Models\School();
                $tempIndex = $schools->calculateIndex('Δημοτικά Σχολεία', $pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'middleSchool':
                $schools = new \App\Models\School();
                $tempIndex = $schools->calculateIndex('Γυμνάσια', $pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'highSchool':
                $schools = new \App\Models\School();
                $tempIndex = $schools->calculateIndex('Λύκεια', $pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'vocationalHighSchool':
                $schools = new \App\Models\School();
                $tempIndex = $schools->calculateIndex('Επαγγελματικά Λύκεια', $pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'schoolLaboratoryCenter':
                $schools = new \App\Models\School();
                $tempIndex = $schools->calculateIndex('Σχολικό Εργαστηριακό Κέντρο', $pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'subway':
                $metro = new \App\Models\Metro();
                $tempIndex = $metro->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'taxi':
                $taxi = new \App\Models\Taxi();
                $tempIndex = $taxi->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'stops':
                $stops = new \App\Models\Stop();
                $tempIndex = $stops->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'stopsDisability':
                $stops = new \App\Models\StopDisability();
                $tempIndex = $stops->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'kdap':
                $kdap = new \App\Models\Kdap();
                $tempIndex = $kdap->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'kdapDisability':
                $kdapDisability = new \App\Models\KdapDisability();
                $tempIndex = $kdapDisability->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'rehab':
                $physio= new \App\Models\Physiotherapy();
                $tempIndex = $physio->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'elderly':
                $elderly = new \App\Models\Elderly();
                $tempIndex = $elderly->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'coolingArea':
                $coolingArea = new \App\Models\CoolingArea();
                $tempIndex = $coolingArea->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
            case 'heatingArea':
                $heatingArea = new \App\Models\HeatingArea();
                $tempIndex = $heatingArea->calculateIndex($pathId);
                $arrayFinal[] = [
                    'title' => $arrayTitles[$key],
                    'score' => $tempIndex,
                    'percentage' => ($tempIndex * 100) / 5
                ];
                $tempIndex *= $value;
                $arrayIndex[$key] = $tempIndex;
                break;
        }

        if(!is_null($tempIndex)){
            $flag++;
            $finalIndex += $tempIndex;
        }
    }

    if($flag === 0){
        $finalResult = $realEstateIndex;
    } else {
        $finalResult = ($realEstateIndex+$finalIndex)/2;
    }

    $finalResult = number_format($finalResult, 2);

    $arrayFinal[] = [
        'title' => 'Δείκτης Βιωσιμότητας',
        'score' => $finalResult,
        'percentage' => ($finalResult * 100) / 5
    ];


    return response()->json(['success' => true, 'data' => $arrayFinal]);
});

Route::get('municipality-results/{path_id}', function($pathId) {
    $municipality = \App\Models\Municipality::query()->where('path_id', $pathId)->first();
    if(is_null($municipality)){
        return response()->json(['success' => false, 'status' => '404' ,'message' => 'Municipality not found'], '404');
    }

    $populationTotal = \App\Models\Population::all();
    $sumsByYear = $populationTotal->groupBy('year')
        ->map(function ($items, $year) {
            $men = $items->sum('men');
            $women = $items->sum('women');
            return $men + $women;
        });

    $change = $sumsByYear[2021] - $sumsByYear[2011];
    $variationPop = ($change/$sumsByYear[2011]) * 100;


    $currentMunPopulation = \App\Models\Population::query()
        ->where('municipality_id', $municipality->id)
        ->where('year', 2021)
        ->first();

    $density = ($currentMunPopulation['men'] + $currentMunPopulation['women'])/$municipality->density;

    $criminalityTotal = \App\Models\Criminality::all();
    $sumsByYear2 = $criminalityTotal->groupBy('year')
        ->map(function ($items, $year) {
            return $items->sum('number_of_crimes');
        });

    $change = $sumsByYear2[2019] - $sumsByYear2[2010];
    $variationCrim = ($change/$sumsByYear2[2010]) * 100;

    $realEstates = \App\Models\RealEstate::query()
        ->where('municipality_id', $municipality->id)->get();

    $realEstateFinal = [];
    foreach ($realEstates as $realEstate)
    {
        $realEstateFinal[$realEstate['year']] = number_format($realEstate['apartment_price'],2);
    }

    $NO2Total = \App\Models\Pollution::query()
        ->where('municipality_id',  $municipality->id)
        ->whereBetween('date', ["2022-01-01", "2022-12-31"])
        ->where('pollutant', 'NO2')
        ->whereNotNull('value')
        ->avg('value');

    $SO2Total = \App\Models\Pollution::query()
        ->where('municipality_id',  $municipality->id)
        ->whereBetween('date', ["2022-01-01", "2022-12-31"])
        ->where('pollutant', 'SO2')
        ->whereNotNull('value')
        ->avg('value');

    $O3Total = \App\Models\Pollution::query()
        ->where('municipality_id',  $municipality->id)
        ->whereBetween('date', ["2022-01-01", "2022-12-31"])
        ->where('pollutant', 'O3')
        ->whereNotNull('value')
        ->avg('value');

    $PM25Total = \App\Models\Pollution::query()
        ->where('municipality_id',  $municipality->id)
        ->whereBetween('date', ["2022-01-01", "2022-12-31"])
        ->where('pollutant', 'PM2.5')
        ->whereNotNull('value')
        ->avg('value');

    $PM10Total = \App\Models\Pollution::query()
        ->where('municipality_id',  $municipality->id)
        ->whereBetween('date', ["2022-01-01", "2022-12-31"])
        ->where('pollutant', 'PM10')
        ->whereNotNull('value')
        ->avg('value');

    /* -------------------------------------------------------------------------------- */
    $subwayTotal = \App\Models\Metro::query()->where('municipality_id', $municipality->id)->count();
    $taxiTotal = \App\Models\Taxi::query()->where('municipality_id', $municipality->id)->count();
    $busTotal = \App\Models\Stop::query()->where('municipality_id', $municipality->id)->count();
    $busDisabilityTotal = \App\Models\StopDisability::query()->where('municipality_id', $municipality->id)->count();
    /* -------------------------------------------------------------------------------- */
    $baseQuery = \App\Models\School::query()->where('municipality_id', $municipality->id);

    $preSchoolTotal = (clone $baseQuery)->where('kind', 'Νηπιαγωγεία')->count();
    $primarySchoolTotal = (clone $baseQuery)->where('kind', 'Δημοτικά Σχολεία')->count();
    $middleSchoolTotal = (clone $baseQuery)->where('kind', 'Γυμνάσια')->count();
    $highSchoolTotal = (clone $baseQuery)->where('kind', 'Λύκεια')->count();
    $vocationalHighSchoolTotal = (clone $baseQuery)->where('kind', 'Επαγγελματικά Λύκεια')->count();
    $schoolLaboratoryCenterTotal = (clone $baseQuery)->where('kind', 'Σχολικό Εργαστηριακό Κέντρο')->count();
    /* -------------------------------------------------------------------------------- */

    $finalResults =  [
        'O3Total' => $O3Total ? number_format($O3Total,2) : '-',
        'NO2Total' => $NO2Total ? number_format($NO2Total,2) : '-',
        'SO2Total' => $SO2Total ? number_format($SO2Total,2) : '-',
        'PM25Total' => $PM25Total ? number_format($PM25Total,2) : '-',
        'PM10Total' => $PM10Total ? number_format($PM10Total,2) : '-',
        'populationTotal' => ['total' => $sumsByYear[2021], 'variation' => number_format($variationPop, 2)],
        'density' => number_format($density,0),
        'criminalityTotal' => ['total' => $sumsByYear2[2019], 'variation' => number_format($variationCrim, 2)],
        'realEstateTotal' => $realEstateFinal,
        'populationGender' => ['men' => $currentMunPopulation['men'], 'women' => $currentMunPopulation['women']],
        'subwayTotal' => $subwayTotal,
        'taxiTotal' => $taxiTotal,
        'busTotal' => $busTotal,
        'busDisabilityTotal' => $busDisabilityTotal,
        'preSchoolTotal' => $preSchoolTotal,
        'primarySchoolTotal' => $primarySchoolTotal,
        'middleSchoolTotal' => $middleSchoolTotal,
        'highSchoolTotal' => $highSchoolTotal,
        'vocationalHighSchoolTotal' => $vocationalHighSchoolTotal,
        'schoolLaboratoryCenterTotal' => $schoolLaboratoryCenterTotal
    ];

    return response()->json(['success'=>true, 'data' => $finalResults]);
});

Route::get('testing', function (){
    $schools = new \App\Models\School();
    $schoolIndex = $schools->calculateIndex('Γυμνάσια', 'path3900');

    return [
        'title' => 'Γυμνάσια',
        'score' => $schoolIndex,
        'percentage' => ($schoolIndex * 100) / 5
    ];
});

Route::get('getFields/{field}', function ($field){
    if($field == 'municipality') {
        $results = collect(config('draft.filters.municipalities'))->sort();
    } elseif($field == 'schools') {
        $results = \App\Models\School::query()->distinct()->orderBy('kind')->pluck('kind');
    }

    return response()->json(['success' => true, 'data' => $results]);
});

Route::post('fetchSchoolData', function (Request $request){

    if($request->input('municipality') == 'Όλα' && $request->input('kind') == 'Όλα') {
        $results = \App\Models\School::with('municipality');
    } elseif ($request->input('municipality') != 'Όλα' && $request->input('kind') == 'Όλα') {
        $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
        $results = \App\Models\School::with('municipality')
            ->where('municipality_id', $municipalityId);
    } elseif ($request->input('municipality') == 'Όλα' && $request->input('kind') != 'Όλα') {
        $results = \App\Models\School::with('municipality')
            ->where('kind', $request->input('kind'));
    } else {
        $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
        $results = \App\Models\School::with('municipality')
            ->where('kind', $request->input('kind'))
            ->where('municipality_id', $municipalityId);
    }
    $results = $results->paginate(10, ['id', 'name', 'kind', 'type', 'phone', 'fax', 'email', 'municipality_id', 'address', 'post_code']);
    $collection = $results->getCollection();

    $transformed = $collection->map(function ($school) {
        return [
            'name' => $school->name,
            'kind' => $school->kind,
            'type' => $school->type,
            'phone' => $school->phone,
            'fax' => $school->fax,
            'email' => $school->email,
            'municipality' => $school->municipality->name ?? null,
            'address' => $school->address,
            'post_code' => $school->post_code,
        ];
    });

    $headers = [
        'Όνομα',
        'Είδος',
        'Τύπος',
        'Τηλέφωνο',
        'Φαξ',
        'Email',
        'Δήμος',
        'Διεύθυνση',
        'Τ.Κ.'
    ];

    $finalData = [
        'headers' => $headers,
        'values' => $transformed->toArray()
    ];

    $results->setCollection(collect($finalData));
    return $results;
});

Route::post('fetchTransData', function (Request $request) {

    if($request->input('trans') == 'Μετρό') {
        $results = \App\Models\Metro::query()->with('municipality');

        if($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'name', 'line', 'road', 'latitude', 'longitude', 'municipality_id']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'name' => $trans->name,
                'line' => $trans->line,
                'road' => $trans->road,
                'map_url' => "https://www.openstreetmap.org/?mlat=$trans->latitude&mlon=$trans->longitude",
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Όνομα',
            'Γραμμή',
            'Οδός',
            'Χάρτης',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('trans') == 'Ταξί') {
        $results = \App\Models\Taxi::query()->with('municipality');;

        if($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'name', 'area', 'latitude', 'longitude', 'municipality_id']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'name' => $trans->name,
                'area' => $trans->area,
                'map_url' => "https://www.openstreetmap.org/?mlat=$trans->latitude&mlon=$trans->longitude",
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Όνομα',
            'Περιοχή',
            'Χάρτης',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('trans') == 'Στάσεις') {
        $results = \App\Models\Stop::query()->with('municipality');;

        if($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'stop_code', 'stop_description', 'stop_street', 'stoptyp_code', 'stop_url', 'municipality_id']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'stop_code' => $trans->stop_code,
                'stop_description' => $trans->stop_description,
                'stop_street' => $trans->stop_street,
                'stoptyp_code' => $trans->stoptyp_code,
                'stop_url' => $trans->stop_url,
                'municipality' => $trans->municipality->name ?? null
            ];
        });

        $headers = [
            'Κωδικός Στάσης',
            'Περιγραφή',
            'Οδός',
            'Είδος',
            'Στοιχεία ΟΑΣΑ',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('trans') == 'Στάσεις με Μπάρα') {
        $results = \App\Models\StopDisability::query()->with('municipality');;

        if($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'stop_code', 'stop_name', 'stop_street', 'latitude', 'longitude', 'stop_url', 'municipality_id']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'stop_code' => $trans->stop_code,
                'stop_name' => $trans->stop_name,
                'stop_street' => $trans->stop_street,
                'map_url' => "https://www.openstreetmap.org/?mlat=$trans->latitude&mlon=$trans->longitude",
                'stop_url' => $trans->stop_url,
                'municipality' => $trans->municipality->name ?? null
            ];
        });

        $headers = [
            'Κωδικός Στάσης',
            'Όνομα',
            'Οδός',
            'Χάρτης',
            'Στοιχεία ΟΑΣΑ',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    }

    return $results;
});

Route::post('fetchOtherData', function (Request $request) {

    if($request->input('other') == 'Θερμαινόμενοι χώροι') {
        $results = \App\Models\HeatingArea::query()->with('municipality');

        if($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'municipality_id', 'building', 'address', 'phone', 'time']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'building' => $trans->building,
                'address' => $trans->address,
                'phone' => $trans->phone,
                'time' => $trans->time,
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Κτήριο',
            'Οδός',
            'Τηλέφωνο',
            'Ωράριο Λειτουργίας',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('other') == 'Κλιματιζόμενοι χώροι') {
        $results = \App\Models\CoolingArea::query()->with('municipality');

        if ($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'municipality_id', 'building', 'address', 'phone', 'time']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'building' => $trans->building,
                'address' => $trans->address,
                'phone' => $trans->phone,
                'time' => $trans->time,
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Κτήριο',
            'Οδός',
            'Τηλέφωνο',
            'Ωράριο Λειτουργίας',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('other') == 'Κέντρα Δημιουργικής Απασχόλησης Παίδων') {
        $results = \App\Models\Kdap::query()->with('municipality');

        if ($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'municipality_id', 'name', 'address', 'phone', 'site', 'email']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'name' => $trans->name,
                'address' => $trans->address,
                'phone' => $trans->phone,
                'email' => $trans->email,
                'site' => $trans->site,
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Όνομα',
            'Οδός',
            'Τηλέφωνο',
            'Email',
            'Ιστοσελίδα',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('other') == 'Κέντρα Δημιουργικής Απασχόλησης Παίδων με Αναπηρία') {
        $results = \App\Models\KdapDisability::query()->with('municipality');

        if ($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'municipality_id', 'name', 'address', 'phone', 'site', 'email']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'name' => $trans->name,
                'address' => $trans->address,
                'phone' => $trans->phone,
                'email' => $trans->email,
                'site' => $trans->site,
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Όνομα',
            'Οδός',
            'Τηλέφωνο',
            'Email',
            'Ιστοσελίδα',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('other') == 'Κέντρα Φροντίδας Ηλικιωμένων') {
        $results = \App\Models\Elderly::query()->with('municipality');

        if ($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'municipality_id', 'name', 'institution', 'type', 'capacity', 'license', 'address', 'phone', 'site', 'email']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'name' => $trans->name,
                'institution' => $trans->institution,
                'type' => $trans->type,
                'capacity' => $trans->capacity,
                'license' => $trans->license,
                'address' => $trans->address,
                'phone' => $trans->phone,
                'email' => $trans->email,
                'site' => $trans->site,
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Όνομα',
            'Ίδρυμα',
            'Τύπος',
            'Χωρητικότητα',
            'Άδεια',
            'Διεύθυνση',
            'Τηλέφωνο',
            'Email',
            'Ιστοσελίδα',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    } elseif ($request->input('other') == 'Κέντρα Αποθεραπείας - Αποκατάστασης') {
        $results = \App\Models\Physiotherapy::query()->with('municipality');

        if ($request->input('municipality') != 'Όλα') {
            $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
            $results = $results->where('municipality_id', $municipalityId);
        }

        $results = $results->paginate(10, ['id', 'municipality_id', 'name', 'category', 'address', 'site', 'email', 'phone']);

        $collection = $results->getCollection();

        $transformed = $collection->map(function ($trans) {
            return [
                'name' => $trans->name,
                'category' => $trans->category,
                'address' => $trans->address,
                'email' => $trans->email,
                'site' => $trans->site,
                'phone' => $trans->phone,
                'municipality' => $trans->municipality->name ?? null,
            ];
        });

        $headers = [
            'Όνομα',
            'Κατηγορία',
            'Διεύθυνση',
            'Email',
            'Ιστοσελίδα',
            'Τηλέφωνο',
            'Δήμος'
        ];

        $finalData = [
            'headers' => $headers,
            'values' => $transformed->toArray()
        ];

        $results->setCollection(collect($finalData));
    }

    return $results;
});

Route::post('fetchAirPollutionData', function (Request $request) {

    $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
    $results = \App\Models\Pollution::query()
        ->where('date', '>', '2009-12-31')
        ->where('municipality_id', $municipalityId);

    if($request->input('pollution') == 'Μονοξείδιο του Αζώτου') {
        $results = $results->where('pollutant', 'NO');
    } elseif ($request->input('pollution') == 'Διοξείδιο του Αζώτου') {
        $results = $results->where('pollutant', 'NO2');
    } elseif ($request->input('pollution') == 'Όζον') {
        $results = $results->where('pollutant', 'O3');
    } elseif ($request->input('pollution') == 'Μονοξείδιο του Άνθρακα') {
        $results = $results->where('pollutant', 'CO');
    } elseif ($request->input('pollution') == 'Διοξείδιο του Θείου') {
        $results = $results->where('pollutant', 'SO2');
    } elseif ($request->input('pollution') == 'Μικροσωματίδια PM10') {
        $results = $results->where('pollutant', 'PM10');
    } elseif ($request->input('pollution') == 'Μικροσωματίδια PM2.5') {
        $results = $results->where('pollutant', 'PM2.5');
    }

    // Group by year and quarter, and calculate the average value
    $results = $results->selectRaw('YEAR(date) as year, QUARTER(date) as quarter, AVG(value) as value')
        ->groupBy('year', 'quarter');

    return $results->get();
});

Route::get('fetchRealEstateData', function (Request $request) {

    $results = \App\Models\RealEstate::query()
        ->with('municipality')
        ->where('year', $request->input('year'))
        ->get();

    $transformed = $results->map(function ($data) {
        return [
            'municipality' => $data->municipality->name ?? null,
            'sector' => $data->municipality->sector,
            'apartment_price' => $data->apartment_price
        ];
    });

    $headers = [
        'Δήμος',
        'Τομέας',
        'Τιμή (€/τ.μ.)'
    ];

    $finalData = [
        'headers' => $headers,
        'values' => $transformed->toArray()
    ];

    return response()->json(['success' => true, 'data' => $finalData]);
});

Route::get('fetchBankOfGreeceData', function () {
    $results = \Illuminate\Support\Facades\DB::query()->select(['year', 'quarter', 'apartment_index as value'])->from('bank_of_greece')
        ->where('year', '>=', '2010')->get();

    return response()->json(['success' => true, 'data' => $results]);
});

Route::get('fetchPopulationData', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'municipality' => [\Illuminate\Validation\Rule::in(config('draft.filters.municipalities'))],
        'year' => [\Illuminate\Validation\Rule::in(['2011', '2021'])]
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => 'false',
            'status' => '422',
            'errors' => $validator->errors()
        ], 422); // HTTP status code 422 indicates unprocessable entity
    }

    if(!is_null($request->input('municipality'))){
        $municipalityId = \App\Models\Municipality::query()->where('name', $request->input('municipality'))->first()->id;
        $results = \App\Models\Population::query()->where('municipality_id', $municipalityId)->get(['municipality_id', 'year', 'men', 'women']);
    } elseif (!is_null($request->input('year'))) {
        $results = \App\Models\Population::query()->with('municipality')
            ->where('year', $request->input('year'))->get(['municipality_id', 'year', 'men', 'women']);

        $results = $results->map(function ($data) {
            return [
                'population' => $data->men + $data->women,
                'municipality' => $data->municipality->name ?? null,
            ];
        });
    }

    return response()->json(['success' => true, 'data' => $results]);
});

Route::get('fetchCriminalityData', function (Request $request) {




    if($request->input('data') === 'all') {

        $results = \App\Models\Criminality::query();

        if(!is_null($request->input('year'))) {

            $filteredResults = \App\Models\Criminality::where('year', $request->input('year'))
                ->get(['type', 'number_of_crimes'])->toBase();

            $sums = collect([
                [
                    'type' => 'Κλοπές Τροχοφόρων',
                    'number_of_crimes' => $filteredResults->filter(function ($item) {
                        return str_contains($item->type, 'Κλοπές Τροχοφόρων');
                    })->sum('number_of_crimes')
                ],
                [
                    'type' => 'Ληστείες',
                    'number_of_crimes' => $filteredResults->filter(function ($item) {
                        return str_contains($item->type, 'Ληστείες');
                    })->sum('number_of_crimes')
                ],
                [
                    'type' => 'Κλοπές - Διαρρήξεις',
                    'number_of_crimes' => $filteredResults->filter(function ($item) {
                        return str_contains($item->type, 'Κλοπές') && !str_contains($item->type, 'Κλοπές Τροχοφόρων');
                    })->sum('number_of_crimes')
                ]
            ]);

            $finalResults = $filteredResults->reject(function ($item) {
                return str_contains($item->type, 'Κλοπές') || str_contains($item->type, 'Ληστείες');
            });

            $finalResults = $finalResults->merge($sums);

            $results = [
                'headers' => [
                    'Τύπος Εγκλήματος',
                    'Αριθμός Εγκλημάτων'
                ],
                'values' => $finalResults
            ];

        } elseif (!is_null($request->input('criminality'))) {

            if ($request->input('criminality') == 'Κλοπές - Διαρρήξεις') {
                $results = \App\Models\Criminality::query()
                    ->selectRaw("year, SUM(CASE WHEN type LIKE '%Κλοπές%' AND type NOT LIKE '%Κλοπές Τροχοφόρων%' THEN number_of_crimes ELSE 0 END) as number_of_crimes")
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();
            } elseif ($request->input('criminality') == 'Κλοπές Τροχοφόρων') {
                $results = \App\Models\Criminality::query()
                    ->selectRaw("year, SUM(CASE WHEN type LIKE '%Κλοπές Τροχοφόρων%' THEN number_of_crimes ELSE 0 END) as number_of_crimes")
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();
            } elseif ($request->input('criminality') == 'Ληστείες') {
                $results = \App\Models\Criminality::query()
                    ->selectRaw("year, SUM(CASE WHEN type LIKE '%Ληστείες%' THEN number_of_crimes ELSE 0 END) as number_of_crimes")
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();
            } else {
                $results = $results->where('type', $request->input('criminality'))
                    ->orderBy('year')
                    ->get(['year', 'number_of_crimes']);
            }
        }

    } elseif ($request->input('data') === 'buildings') {
        $results = \App\Models\Criminality::query()
            ->where('year', $request->input('year'))
            ->where('type', 'like', '%Κλοπές%')
            ->where('type', 'not like', '%Κλοπές Τροχοφόρων%')
            ->get(['type', 'year', 'number_of_crimes']);

    } elseif ($request->input('data') === 'vehicles') {
        $results = \App\Models\Criminality::query()
            ->where('year', $request->input('year'))
            ->where('type', 'like', '%Κλοπές Τροχοφόρων%')
            ->get(['type', 'year', 'number_of_crimes']);
    } elseif ($request->input('data') === 'heists') {
        $results = \App\Models\Criminality::query()
            ->where('year', $request->input('year'))
            ->where('type', 'like', '%Ληστείες%')
            ->get(['type', 'year', 'number_of_crimes']);
    }

    return response()->json(['success' => true, 'data' => $results]);
});
