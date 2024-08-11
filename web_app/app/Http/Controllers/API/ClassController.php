<?php

namespace App\Http\Controllers\API;

use App\Models\ClassModel;
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
        $classes = ClassModel::take(100)
        ->get();

        if($classes == null)
            return response(['message' => 'No class found'], 404);

            return response(['message' => 'Classes found', 'data' => $classes], 200);
    }

    function getClass(Request $request, $id) {
        $class = ClassModel::find($id);

        if($class == null)
            return response(['message' => 'No class found'], 404);
        else
            return response(['message' => 'class found', 'data' => $class], 200);
    }

    function updateClass(Request $request, $id) {
        $data = $request->validate([
            'name' => 'required',
            'descr' => 'required_without'
        ]);

        ClassModel::where('id', $id)
        ->update([
            'name' => $data['name'],
            'descr' => $data['descr']
        ]);

        return response(['message' => 'Class updated successfully'], 200);
    }

    function deleteClass(Request $request, $id) {
        $class = DB::table('class')
        ->where('id', $id)
        ->delete();

        if ($class == 1) {
            return response(['message' => 'Class deleted'], 200);
        }

        return response(['message' => 'Class does not exist'], 400);
    }
}
