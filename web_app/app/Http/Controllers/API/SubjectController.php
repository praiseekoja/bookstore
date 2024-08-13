<?php

namespace App\Http\Controllers\API;

use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //
    function create(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'descr' => 'required_without'
        ]);

        $result = DB::table('subject')->insert([
            'subject_name' => $data['name'],
            'descr' => $data['descr']
        ]);

        if($result){
            return request(['message' => 'subject created'], 200);
        }
        else{
            return request(['message' => 'An error occured'], 400);
        }
    }

    function getSubjects(Request $request) {
        $subjects = Subject::take(100)
        ->get();

        if($subjects == null)
            return response(['message' => 'No Subject found'], 404);

        return response(['message' => 'Subjects found', 'data' => $subjects], 200);
    }

    function getSubject(Request $request, $id) {
        $subject = Subject::find($id);

        if($subject == null)
            return response(['message' => 'No subject found'], 404);

        return response(['message' => 'Subject found', 'data' => $subject], 200);
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

        return response(['message' => 'Subject updated successfully'], 200);
    }

    function deleteSubject(Request $request, $id) {
        $subject = DB::table('subject')
        ->where('id', $id)
        ->delete();

        if ($subject == 1) {
            return response(['message' => 'Subject deleted'], 200);
        }

        return response(['message' => 'Subject does not exist'], 400);
    }
}
