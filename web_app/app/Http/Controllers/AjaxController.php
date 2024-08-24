<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\Book;
use App\Models\User;

class AjaxController extends Controller
{
    private static $url = '/api';
    private static $token = '1|llsMVtuMnY9vXsdygvbnhv7d3TjOksNSQcTkEmR20270ac6f';

    function addSubject(Request $request) {
        $data = $request->validate([
            'name' => 'required|unique:subject,subject_name',
            'descr' => 'required_without'
        ]);

        $result = DB::table('subject')->insert([
            'subject_name' => $data['name'],
            'descr' => $data['descr']
        ]);

        if($result){
            return response()->json([
                'message' => "Subject saved"
            ], 200);
        }
        else{
            return response()->json([
                'message' => "An error occurred"
            ], 400);
        }
    }

    function updateSubject(Request $request, $id) {
        $data = $request->validate([
            'name' => 'required',
            'descr' => 'required_without'
        ]);

        Subject::where('id', $id)
        ->update([
            'subject_name' => $data['name'],
            'descr' => $data['descr']
        ]);

        return response()->json([
            'message' => "Subject saved"
        ], 200);
    }
}
