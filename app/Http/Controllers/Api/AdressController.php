<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adress;
use App\Models\City;

class AdressController extends Controller
{
    public function reply ($action = true, $message = '', $extras = []){
        return [
            'action' => $action,
            'message' => $message,
            'extras' => $extras
        ];
    }

    public function list (Request $request) {
        $adresses = Adress::get();
        
        return response()->json($this->reply(
            true,
            'Adresses List',
            [
                'adresses' => $adresses
            ]
        ), 200);
        
    }
    public function store (Request $request) {
        $data = $request->validate([
            'street' => ['required', 'string'],
            'district' => ['required', 'string'],
            'number' => ['required', 'integer'],
            'id_city' => ['required', 'integer'],
            
        ]);
        $city = City::find($data['id_city']);
        
        $adress = new Adress;
        $adress->street = $data['street'];
        $adress->district = $data['district'];
        $adress->number = $data['number'];
        $adress->city_name = $city->name;
        $adress->id_city = $data['id_city'];

        $adress->save();

        return response()->json($this->reply(
            true,
            'Adresses Created'
           
        ), 201);
        
        
    }
    public function edit (Request $request, $adress_id) {
        $adress = Adress::find($adress_id);
             
        
        return view('adress.edit', compact('adress'));
    }
    public function update (Request $request, $adress_id) {

        $data = $request->validate([
            'street' => ['required', 'string'],
            'district' => ['required', 'string'],
            'number' => ['required', 'integer'],
            'id_city' => ['required', 'integer'],
            
        ]);

        $city = City::find($data['id_city']);
        $adress = Adress::find($adress_id);

        $adress->street = $data['street'];
        $adress->district = $data['district'];
        $adress->number = $data['number'];
        $adress->city_name = $city->name;
        $adress->id_city = $data['id_city']; 
        $adress->save();

        return response()->json($this->reply(
            true,
            'Adresses Updated'
           
        ), 200);
        
    }
    public function delete (Request $request, $adress_id) {
        $adress = Adress::find($adress_id);
        $adress->delete();

        return response()->json($this->reply(
            true,
            'Adresses Deleted'
           
        ), 200);
        
    }
}
