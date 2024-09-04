<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\AdminModel;
use App\Models\Book;
use App\Models\User;
use App\Models\Profile;
use App\Models\Video;

class AjaxController extends Controller
{
    private static $url = '/api';
    private static $token = '1|llsMVtuMnY9vXsdygvbnhv7d3TjOksNSQcTkEmR20270ac6f';

    function addSubject(Request $request) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

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
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

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


    function addVideo(Request $request) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

            $data = $request->validate([
                'video_link' => 'required|unique:video_links,video_link',
                'class_id' => 'required',
                'subject_id' => 'required'
            ]);

            $result = DB::table('video_links')->insert([
                'video_link' => $data['video_link'],
                'subject_id' => $data['subject_id'],
                'class_id' => $data['class_id']
            ]);

            if($result){
                return response()->json([
                    'message' => "Video link saved"
                ], 200);
            }
        else{
            return response()->json([
                'message' => "An error occurred"
            ], 400);
        }
    }

    function updateVideo(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $data = $request->validate([
            'video_link' => 'required',
                'class_id' => 'required',
                'subject_id' => 'required'
        ]);

        Video::where('video_id', $id)
        ->update([
            'video_link' => $data['video_link'],
                'subject_id' => $data['subject_id'],
                'class_id' => $data['class_id']
        ]);

        return response()->json([
            'message' => "Video saved"
        ], 200);
    }

    function addClass(Request $request) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $data = $request->validate([
            'name' => 'required|unique:class,class_name',
            'descr' => 'required_without'
        ]);

        $result = DB::table('class')->insert([
            'class_name' => $data['name'],
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

    function updateClass(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $data = $request->validate([
            'name' => 'required',
            'descr' => 'required_without'
        ]);

        ClassModel::where('id', $id)
        ->update([
            'class_name' => $data['name'],
            'descr' => $data['descr']
        ]);

        return response()->json([
            'message' => "Class saved!"
        ], 200);
    }

    function updateUser(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'phone' => 'required_without',
            'address' => 'required_without',
        ]);

        Profile::where('userId', $id)
        ->update([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'tel' => $data['phone'] ?? null, 'address' => $data['address'] ?? null,
        ]);

        User::where('userId', $id)
        ->update([
            'email' => $data['email'],
            'username' => $data['username']
        ]);

        return response()->json([
            'message' => "User saved!"
        ], 200);
    }


    function addBook(Request $request) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $data = $request->validate([
            'title' => 'required|unique:book,title',
            'price' => 'required',
            'price2' => 'required',
            'descr' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'prev_image' => 'required|mimes:jpeg,bmp,png,jpg|max:1024',
            'docu' => 'required|mimes:pdf'
        ]);

        $uploaded = false;
        $imagUrl = null;
        $doc = null;
        if ($request->file('prev_image') && $request->file('docu')) {
            $file = $request->file('prev_image');
            $docu = $request->file('docu');

            $nam = time() . '_' . $request->file('prev_image')->getClientOriginalName();
            $docNam = time() . '_' . $request->file('docu')->getClientOriginalName();
            $path = 'storage/app/public/book/';
            $path2 = 'storage/app/public/book/document/';
            if ($file->move($path, $nam)){
                $docu->move($path2, $docNam);
                $uploaded = true;
                $imagUrl = "{$path}{$nam}";
                $doc = "{$path2}{$docNam}";
            }
            else{
                $uploaded = false;
                return response()->json([
                    'message' => "An error occurred"
                ], 400);
            }
        }

        if($uploaded){
            $bookId = Str::orderedUuid();

            $book = DB::table('book')->insert([
                'book_id' => $bookId,
                'title' => $data['title'],
                'price' => $data['price'],
                'price2' => $data['price2'],
                'descr' => $data['descr'],
                'class_id' => $data['class_id'],
                'subject_id' => $data['subject_id'],
                'thumbnail' => $imagUrl,
                'book_file' => $doc
            ]);

            if($book == null){
                return response()->json(['message' => 'An error occured while saving image'], 400);
}
                return response()->json([
                    'message' => "Subject saved"
                ], 200);
        }

        return response()->json([
            'message' => "An error occurred"
        ], 400);

    }

    function updateBook(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $data = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'price2' => 'required',
            'descr' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'old_prev_image' => 'required_without',
            'old_docu' => 'required_without'
        ]);

        $uploaded = true;
        $imagUrl = $data['old_prev_image'];
        $doc = $data['old_docu'];

        if ($request->file('prev_image')) {
            $file = $request->file('prev_image');

            $nam = time() . '_' . $request->file('prev_image')->getClientOriginalName();
            $path = 'storage/app/public/book/';
            if ($file->move($path, $nam)){
                $uploaded = true;
                $imagUrl = "{$path}{$nam}";
            }
            else{
                $uploaded = false;
                return response()->json([
                    'message' => "An error occurred"
                ], 400);
            }
        }

        if ($request->file('docu')) {
            $docu = $request->file('docu');

            $docNam = time() . '_' . $request->file('docu')->getClientOriginalName();
            $path2 = 'storage/app/public/book/document/';
            if ($docu->move($path2, $docNam)){
                $uploaded = true;
                $doc = "{$path2}{$docNam}";
            }
            else{
                $uploaded = false;
                return response()->json([
                    'message' => "An error occurred"
                ], 400);
            }
        }

        if($uploaded){
            $book = Book::where('book_id', $id)
            ->update([
                'title' => $data['title'],
                'price' => $data['price'],
                'price2' => $data['price2'],
                'descr' => $data['descr'],
                'class_id' => $data['class_id'],
                'subject_id' => $data['subject_id'],
                'thumbnail' => $imagUrl,
                'book_file' => $doc
            ]);

            if($book == null){
                return response()->json(['message' => 'An error occured while saving image'], 400);
}
                return response()->json([
                    'message' => "Subject saved"
                ], 200);
        }

        return response()->json([
            'message' => "An error occurred"
        ], 400);

    }


    function updateSec(Request $request) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $id = session('overseer');

        $admin = AdminModel::where('adminId', $id)
        ->first();

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|string',
            'username' => 'required|string',
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8'
        ]);

        if(Hash::check($data['old_password'], $admin->password)){
            $admin->password = Hash::make($data['password']);
            $admin->email = $data['email'];
            $admin->username = $data['username'];
            $admin->name = $data['name'];
            $admin->save();

            return response()->json([
                'message' => "Saved!"
            ], 200);
        }

        return response()->json([
            'message' => "Invalid old password!"
        ], 400);

    }


    function deleteSubject(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $subject = DB::table('subject')
        ->where('id', $id)
        ->delete();

        if ($subject == 1) {
            return response()->json(['message' => 'Subject deleted'], 200);
        }

        return response()->json(['message' => 'Subject does not exist'], 400);
    }

    function deleteClass(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $row = DB::table('class')
        ->where('id', $id)
        ->delete();

        if ($row == 1) {
            return response()->json(['message' => 'Class deleted'], 200);
        }

        return response()->json(['message' => 'Class does not exist'], 400);
    }

    function deleteBook(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $row = DB::table('book')
        ->where('book_id', $id)
        ->delete();

        if ($row == 1) {
            return response()->json(['message' => 'Book deleted'], 200);
        }

        return response()->json(['message' => 'Book does not exist'], 400);
    }

    function deleteUser(Request $request, $id) {
        if (!$request->session()->has('overseer'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $row = DB::table('subject')
        ->where('id', $id)
        ->delete();

        if ($row == 1) {
            return response()->json(['message' => 'User deleted'], 200);
        }

        return response()->json(['message' => 'User does not exist'], 400);
    }
}

