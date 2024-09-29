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
            'prev_image' => 'required|mimes:jpeg,bmp,png,jpg|max:1024',
            'docu' => 'required|mimes:pdf'
        ]);

        $uploaded = true;
        $imagUrl = null;
        $doc = null;
        if ($request->file('prev_image') && $request->file('docu')) {
            $file = $request->file('prev_image');
            $docu = $request->file('docu');

            $nam = time() . '_' . $request->file('prev_image')->getClientOriginalName();
            $docNam = time() . '_' . $request->file('docu')->getClientOriginalName();
            $path = 'storage/app/public/book/';
            $path2 = 'storage/app/public/book/document/';
            if ($file->move($path, $nam) && $file->move($path2, $docNam)){
                $uploaded = true;
                $imagUrl = "{$path}{$nam}";
                $doc = "{$path2}{$docNam}";
            }
            else{
                $uploaded = false;
                return response(['message' => 'An error occured when uploading files'], 500);
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
                'subject_id' => $data['subject_id'],
                'thumbnail' => $imagUrl,
                'book_file' => $doc
            ]);

            if($book == null)
                return response(['message' => 'An error occured while saving image'], 400);

            return response(['data' => $book, 'message' => 'Book Created'], 200);
        }

        return response(['message' => 'An error occured when uploading files'], 500);

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
        $query = $request->input('query');
        $subj = $request->input('subject');
        $class = $request->input('class');
        
        $books = Book::where('book.title', 'LIKE', "%{$query}%")
                ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
                ->leftjoin('class', 'book.class_id', '=', 'class.id')
                ->take(20)
                ->get();

        return response(['message' => 'Books found', 'book' => $books, 'class' => $this->getClass($class), 'subject' => $this->getSubject($subj)], 200);
    }

    function getBook(Request $request, $id) {
        $book = Book::where('book_id', $id)
        ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
        ->leftjoin('class', 'book.class_id', '=', 'class.id')
        ->get();

        if($book == null)
            return response(['message' => 'No book found'], 404);

        return response(['message' => 'Book found', 'data' => $book], 200);
    }
    
    function getPopular(Request $request) {
        return response(['message' => 'Book found', 'data' => $this->getBestSelling()], 200);
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
        ->where('book_id', $id)
        ->delete();

        if ($book > 0) {
            return response(['message' => 'Book deleted'], 200);
        }

        return response(['message' => 'Book does not exist'], 400);
    }
    
    private function getBestSelling()
    {
        return DB::table('book')
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->orderBy('book.created_at', 'desc')
            ->take(8)
            ->get();
    }
    
    private function getClass($query)
    {
        return Book::leftjoin('class', 'book.class_id', '=', 'class.id')
                ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
                ->Where('class.class_name', 'LIKE', "%{$query}%")
                ->take(15)
                ->get();
    }

    private function getSubject($query)
    {
        return Book::leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->Where('subject.subject_name', 'LIKE', "%{$query}%")
            ->take(15)
            ->get();
    }
}
