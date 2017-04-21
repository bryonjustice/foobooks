<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Session;

class BookController extends Controller
{

    /**
	* GET
    * /books
	*/
    public function index() {

        $books = Book::orderBy('title')->get(); # Query DB

        $newBooks = Book::orderBy('created_at', 'descending')->limit(3)->get(); # Query DB

        #$newBooks = $books->sortByDesc('created_at')->take(3); # Query existing Collection

        return view('books.index')->with([
            'books' => $books,
            'newBooks' => $newBooks,
        ]);

    }


    /**
	* GET
    * /books/{title?}
	*/
    public function show($title = null) {
        return view('books.show')->with([
            'title' => $title,
        ]);
    }


    /**
    * GET
    * /search
    */
    public function search(Request $request) {

        # Start with an empty array of search results; books that
        # match our search query will get added to this array
        $searchResults = [];

        # Store the searchTerm in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* searchTerm is not in the request.
        $searchTerm = $request->input('searchTerm', null);

        # Only try and search *if* there's a searchTerm
        if($searchTerm) {

            # Open the books.json data file
            # database_path() is a Laravel helper to get the path to the database folder
            # See https://laravel.com/docs/5.4/helpers for other path related helpers
            $booksRawData = file_get_contents(database_path().'/books.json');

            # Decode the book JSON data into an array
            # Nothing fancy here; just a built in PHP method
            $books = json_decode($booksRawData, true);

            # Loop through all the book data, looking for matches
            # This code was taken from v1 of foobooks we built earlier in the semester
            foreach($books as $title => $book) {

                # Case sensitive boolean check for a match
                if($request->has('caseSensitive')) {
                    $match = $title == $searchTerm;
                }
                # Case insensitive boolean check for a match
                else {
                    $match = strtolower($title) == strtolower($searchTerm);
                }

                # If it was a match, add it to our results
                if($match) {
                    $searchResults[$title] = $book;
                }

            }
        }

        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('books.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }


    /**
    * GET
    * /books/new
    * Display the form to add a new book
    */
    public function createNewBook(Request $request) {
        return view('books.new');
    }



    /**
    * POST
    * /books/new
    * Process the form for adding a new book
    */
    public function storeNewBook(Request $request) {

        $this->validate($request, [
            'title' => 'required|min:3',
            'published' => 'required|numeric',
            'cover' => 'required|url',
            'purchase_link' => 'required|url'
        ]);

        # Add new book to database
        $book = new Book();
        $book->title = $request->title;
        $book->published = $request->published;
        $book->cover = $request->cover;
        $book->purchase_link = $request->purchase_link;
        $book->save();

        Session::flash('message', 'The book '.$request->title.' was added.');

        # Redirect the user to book index
        return redirect('/books');
    }

    /**
	* GET
    * /books/edit/{id}
	*/
    public function edit($id) {

        $book = Book::find($id);

        if(is_null($book)) {
            Session::flash('message', 'Book not found.');
            return redirect('/books');
        }

        return view('books.edit')->with([
            'id' => $id,
            'book' => $book,
        ]);

    }

    /**
	* POST
    * /books/edit
	*/
    public function saveEdits(Request $request) {

        $this->validate($request, [
            'title' => 'required|min:3',
            'published' => 'required|numeric',
            'cover' => 'required|url',
            'purchase_link' => 'required|url'
        ]);

        $book = Book::find($request->id);

        # Edit book in the database
        $book->title = $request->title;
        $book->published = $request->published;
        $book->cover = $request->cover;
        $book->purchase_link = $request->purchase_link;
        $book->save();

        Session::flash('message', 'Your changes were saved');
        return redirect('/books/edit/'.$request->id);

    }

}
