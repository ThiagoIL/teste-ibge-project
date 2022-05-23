<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function reply ($action = true, $message = '', $extras = []){
        return [
            'action' => $action,
            'message' => $message,
            'extras' => $extras
        ];
    }

    public function list (Request $request) {
        $cities = City::get();

        return response()->json($this->reply(
            true,
            'Cidades do RN',
            [
                'cities' => $cities
            ]
        ), 200);

    }
}
