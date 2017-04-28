<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#use Rych\Random\Random; Added an alias for this in config/app.php so no longer need this

use App\Book;
use App\Author;

class PracticeController extends Controller {

    /**
    * Lecture 13
    */
    public function practice23() {
        $books = Book::with('tags')->get();

        foreach($books as $book) {
            dump($book->title.' is tagged with: ');
            foreach($book->tags as $tag) {
                dump($tag->name.' ');
            }
        }
    }


    /**
    * Lecture 13
    */
    public function practice22() {

        $book = Book::where('title','=','The Great Gatsby')->first();

        dump($book->title.' is tagged with: ');
        foreach($book->tags as $tag) {
            dump($tag->name);
        }
    }


    /**
    * Lecture 13
    */
    public function practice21() {

        # Eager load the author with the book
        $books = Book::with('author')->get();

        foreach($books as $book) {
            echo $book->author->first_name.' '.$book->author->last_name.' wrote '.$book->title.'<br>';
        }

        dump($books->toArray());
    }


    /**
    * Lecture 13
    */
    public function practice20() {

        # Get the first book as an example
        $book = Book::first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title.' was written by '.$author->first_name.' '.$author->last_name);
        dump($book->toArray());

    }


    /**
    * Lecture 13
    */
    public function practice19() {

        $author = Author::where('first_name','=','J.K.')->first();

        $book = new Book;
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published = 2017;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781338132311_p0_v2_s192x300.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        #$book->author_id = $author->id;
        $book->save();
        dump($book->toArray());

    }


    /**
    * Lecture 12
    */
    public function practice18() {
        # The code from this example was moved to the BookController.php
    }


    /**
    * Solution to practice task from Eloquent notes
    * Retrieve the last 5 books that were added to the books table.
    */
    public function practice17() {

        # Ref: https://laravel.com/docs/5.2/queries#ordering-grouping-limit-and-offset
        $books = Book::orderBy('id', 'desc')->get()->take(5);

        dump($books->toArray());

        # Underlying SQL: select * from `books` order by `id` desc

    }


    /**
    * Solution to practice task from Eloquent notes
    * Retrieve all the books published after 1950.
    */
    public function practice16() {

        $books = Book::where('published','>',1950)->get();

        dump($books->toArray());

        # Underlying SQL: select * from `books` where `published` > '1950'

    }


    /**
    * Solution to practice task from Eloquent notes
    * Retrieve all the books in alphabetical order by title
    */
    public function practice15() {

        $books = Book::orderBy('title','asc')->get();

        dump($books->toArray());

        # Underlying SQL: select * from `books` order by `title` asc
    }



    /**
    * Solution to practice task from Eloquent notes
    * Retrieve all the books in descending order according to published date
    */
    public function practice14() {

        $books = Book::orderBy('published','desc')->get();

        dump($books->toArray());

        # Underlying SQL: select * from `books` order by `published` desc

    }


    /**
    * Solution to practice task from Eloquent notes
    * Find any books by the author Bell Hooks and update the author name to be bell hooks (lowercase).
    */
    public function practice13() {

        # Approach # 1
        # Get all the books that match the criteria
        $books = Book::where('author','=','Bell Hooks')->get();

        # Loop through each book and update them
        foreach($books as $book) {
            $book->author = 'bell hooks';
            $book->save();
        }

        # Resulting SQL:
        # Always:
        #   1) select * from `books` where `author` = 'Bell Hooks'
        # Only if there's something to update:
        #   2) update `books` set `updated_at` = '2016-04-12 18:46:04', `author` = 'bell hooks' where `id` = '8'

        # Approach #2
        Book::where('author', '=', 'Bell Hooks')->update(['author' => 'bell hooks']);
        # Resulting SQL:
        # Always:
        #   1) update `books` set `author` = 'bell hooks', `updated_at` = '2016-04-12 18:44:46' where `author` = 'Bell Hooks'

        return '"Bell Hooks" => "bell hooks"';
    }


    /**
    * Solution to practice task from Eloquent notes
    * Remove any books by the author “J.K. Rowling”
    */
    public function practice12() {

        Book::where('author','LIKE','J.K. Rowling')->delete();

        # Resulting SQL: delete from `books` where `author` LIKE 'J.K. Rowling'

        return 'Deleted all books where author like J.K. Rowling';
    }


    /**
    * Lecture 11) Delete example
    */
    public function practice11() {

        $book = Book::find(11);

        if(!$book) {
            dump('Did not delete book 11, did not find it.');
        }
        else {
            $book->delete();
            dump('Deleted book #11');
        }

    }


    /**
    * Lecture 11) One way to update multiple rows
    */
    public function practice10() {

        # First get a book to update
        $books = Book::where('author', 'LIKE', '%Scott%')->get();

        if(!$book) {
            dump("Book not found, can't update.");
        }
        else {
            foreach($books as $key => $book) {

                # Change some properties
                $book->title = 'The Really Great Gatsby';
                $book->published = '2025';

                # Save the changes
                $book->save();
            }

            dump('Update complete; check the database to confirm the update worked.');
        }

    }


    /**
    * Lecture 11) Update a single row
    */
    public function practice9() {

        # First get a book to update
        $book = Book::where('author', 'LIKE', '%Scott%')->get();

        if(!$book) {
            dump("Book not found, can't update.");
        }
        else {

            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published = '2025';

            # Save the changes
            $book->save();


            dump('Update complete; check the database to confirm the update worked.');
        }

    }


    /**
    * Lecture 11) Constraint chaining
    */
    public function practice8() {

        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')
        ->orWhere('published', '>=', 1800)
        ->orderBy('created_at','desc')
        ->get();

        dump($books->toArray());

    }

    /**
    * Lecture 11) Get all books
    */
    public function practice7() {

        $book = new Book();

        $books = $book->all();

        dump($books->toArray());

    }


    /**
    * Lecture 11) Create a new book
    */
    public function practice6() {

        $newBook = new Book();

        $newBook->title = "Harry Potter and the Sorcerer's Stone";
        $newBook->author = 'J.K. Rowling';
        $newBook->published = 1997;
        $newBook->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $newBook->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        $newBook->save();

        dump($newBook->toArray());

    }


    /**
    * Example for Clayton
    */
    public function practice5() {
        echo $this->variableSetInController;
    }


    /**
    * https://github.com/susanBuck/dwa15-spring2017-notes/blob/master/03_Laravel/15_Composer_Packages.md
    */
    public function practice4() {

        # Method 1) No alias, no use statement
        #$random = new \Rych\Random\Random();

        # Method 2) Assuming `use Rych\Random\Random;` at the top
        #$random = new Random();

        # Method 3) When set as an alias in config/app.php
        $random = new \Random();

        return $random->getRandomString(8);

    }

    /**
    *
    */
    public function practice3() {

        $random = new \Random;

        // Generate a 16-byte string of random raw data
        $randomBytes = $random->getRandomBytes(16);
        dump($randomBytes);

        // Get a random integer between 1 and 100
        $randomNumber = $random->getRandomInteger(1, 100);
        dump($randomNumber);

        // Get a random 8-character string using the
        // character set A-Za-z0-9./
        $randomString = $random->getRandomString(8);
        dump($randomString);
    }

    /**
    *
    */
    public function practice2() {

        dump(config('app'));

    }



    /**
    *
    */
    public function practice1() {
        dump('This is the first example.');
    }


    /**
    * ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    * http://foobooks.loc/practice/1 => Invokes practice1
    * http://foobooks.loc/practice/5 => Invokes practice5
    * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
    */
    public function index($n = null) {

        # If no specific practice is specified, show index of all available methods
        if(is_null($n)) {
            foreach(get_class_methods($this) as $method) {
                if(strstr($method, 'practice'))
                echo "<a href='".str_replace('practice','/practice/',$method)."'>" . $method . "</a><br>";
            }
        }
        # Otherwise, load the requested method
        else {
            $method = 'practice'.$n;

            if(method_exists($this, $method))
            return $this->$method();
            else
            dd("Practice route [{$n}] not defined");
        }

    }
}
