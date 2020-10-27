<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OngkirController extends Controller
{

    public function index(){
        $provinces = $this->getProvince();
        return view('welcome')->with([
            'provinces' => $provinces
        ]);
    }

    public function cekOngkir(Request $request){
        $origin = $request->city_origin;
        $destination = $request->city_destination;
        $weight = $request->weight;
        $couriers = [
            'jne','tiki','pos'
        ];

        $result = [];
        foreach($couriers as $index => $courier){
            $result[$index] = $this->getPrice($origin,$destination,$weight,$courier)[0];
        }

        return view('result')->with([
            'ongkirs' => $result
        ]);

    }

    public function getProvince(){

        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: d13d23ee473e7d77b5884202294c31ec"
          ),
        ));
        
        $response = curl_exec($curl);
        $data = json_decode($response);
    
        return $data->rajaongkir->results;
    
    }
    
    public function getCities(Request $request){
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$request->province_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: d13d23ee473e7d77b5884202294c31ec"
          ),
        ));
        
        $response = curl_exec($curl);
        $data = json_decode($response);
    
        return $data->rajaongkir->results;
    }

    public function getPrice($origin,$destination,$weight,$courier)
    {

      if ($weight < 1) {
        $weight = 1;
      }

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded",
          "key: d13d23ee473e7d77b5884202294c31ec"
        ),
      ));
      
      $response = curl_exec($curl);
      $data = json_decode($response);

      return $data->rajaongkir->results;
    }
}
