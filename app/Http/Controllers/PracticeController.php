<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#use Rych\Random\Random; Added an alias for this in config/app.php so no longer need this

use App\Book;

class PracticeController extends Controller {

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
