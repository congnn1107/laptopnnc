<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalController extends Controller
{
    //
    public function getProvinces(){
        $provinces =  DB::table('province')->get();
        $data = [];
        foreach($provinces as $province){
            $data[]=[
                'id' => $province->id,
                'text' => $province->_name
            ];
        }
        return response()->json($data);
    }
    
    public function getDistricts($proviceID){
        $districts =  DB::table('district')->where('_province_id',$proviceID)->get();
        $data = [];
        foreach($districts as $district){
            $data[]=[
                'id' => $district->id,
                'text' => "$district->_prefix $district->_name"
            ];
        }
        return response()->json($data);
    }

    public function getWards($districtID){
        $wards =  DB::table('ward')->where('_district_id',$districtID)->get();
        $data = [];
        foreach($wards as $ward){
            $data[]=[
                'id' => $ward->id,
                'text' => "$ward->_prefix $ward->_name"
            ];
        }
        return response()->json($data);
    }
}
