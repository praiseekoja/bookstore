<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    function create(Request $request) {
        $data = $request->validate([
            'title' => 'required|unique:book,title',
            'price' => 'required',
            'descr' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'prev_image' => 'required|mimes:jpeg,bmp,png,jpg|max:1024'
        ]);

        $uploaded = true;
        $imagUrl = null;
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
                return response(['message' => 'An error occured when uploading image'], 500);
            }
        }

        if($uploaded){
            $bookId = Str::orderedUuid();

            $book = Book::create([
                'book_id' => $bookId,
                'title' => $data['title'],
                'price' => $data['price'],
                'descr' => $data['descr'],
                'class_id' => $data['class_id'],
                'subject_id' => $data['subject_id']
            ]);

            if($book == null)
                return response(['message' => 'An error occured'], 400);

            return response(['data' => $book, 'message' => 'Book Created'], 200);
        }

    }

    function getBooks(Request $request) {
        $books = Book::leftjoin('subject', 'book.subject_id', '=', 'subject.id')
        ->leftjoin('class', 'book.class_id', '=', 'class.id')
        ->take(100)
        ->get();

        if($books == null)
            return response(['message' => 'No book found'], 404);

        return response(['message' => 'Books found', 'data' => $books], 200);
    }

    function findBooks(Request $request) {
        $query = $request->query('query', '');

        $books = Book::where('book.title', 'LIKE', "%{$query}%")
        ->orWhere('subject.subject_name', 'LIKE', "%{$query}%")
        ->orWhere('class.class_name', 'LIKE', "%{$query}%")
        ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
        ->leftjoin('class', 'book.class_id', '=', 'class.id')
        ->take(100)
        ->get();

        if($books == null)
            return response(['message' => 'No book found'], 404);

        return response(['message' => 'Books found', 'data' => $books], 200);
    }

    function getBook(Request $request, $id) {
        $book = Book::leftjoin('subject', 'book.subject_id', '=', 'subject.id')
        ->leftjoin('class', 'book.class_id', '=', 'class.id')
        ->find($id);

        if($book == null)
            return response(['message' => 'No book found'], 404);

        return response(['message' => 'Book found', 'data' => $book], 200);
    }

    function updateBook(Request $request, $id) {
        $data = $request->validate([
            'title' => 'required|unique:book,title',
            'price' => 'required',
            'descr' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'prev_image' => 'required|mimes:jpeg,bmp,png,jpg|max:1024'
        ]);

        $uploaded = true;
        $imagUrl = null;
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
                return response(['message' => 'An error occured when uploading image'], 500);
            }
        }

        if($uploaded){
            $row = Book::where('id', $id)
            ->update([
                'title' => $data['title'],
                'price' => $data['price'],
                'descr' => $data['descr'],
                'class_id' => $data['class_id'],
                'subject_id' => $data['subject_id']
            ]);

            if($row > 0)
                return response(['message' => 'Book updated successfully'], 200);
        }

        return response(['message' => 'Book not found'], 404);

    }

    function deleteBook(Request $request, $id) {
        $book = DB::table('book')
        ->where('id', $id)
        ->delete();

        if ($book > 0) {
            return response(['message' => 'Book deleted'], 200);
        }

        return response(['message' => 'Book does not exist'], 400);
    }
}
