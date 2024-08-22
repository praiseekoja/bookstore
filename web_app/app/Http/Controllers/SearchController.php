<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Import your model

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('query');

        // Check if the search query is not empty
        if (!empty($query)) {
            // Perform the search using Eloquent ORM
            $results = Book::where('title', 'LIKE', "%{$query}%")
                           ->orWhere('content', 'LIKE', "%{$query}%")
                           ->get();
        } else {
            // If no search query, return all records or an empty result set
            $results = Book::all();  // Optional: Change to an empty collection if needed
        }

        // Return the results to the view
        return view('search', compact('results', 'query'));
    }
}
