<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    //
    function create(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'descr' => 'required_without'
        ]);

        $result = DB::table('class')->insert([
            'name' => $data['name'],
            'descr' => $data['descr']
        ]);

        if($result){
            return request(['message' => 'Class created'], 200);
        }
        else{
            return request(['message' => 'An error occured'], 400);
        }
    }

    function getClasses(Request $request) {
        
    }
}
