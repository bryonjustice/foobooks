<?php

use Illuminate\Database\Seeder;

use App\Book;
use App\Author;

class BooksTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        # 2017-04-20: I optimized this seeder so the content is pulled from
        # the books.json file we used earlier in the semester.
        # Also made it so created_at/updated_at timestamps are unique.
        #
        # If you want to recall how it was originally done in Lecture 11:
        # https://github.com/susanBuck/foobooks/blob/3ac08d4c6b0e45aec4e3aa380073366e3f8b6222/database/seeds/BooksTableSeeder.php

        # Load json file into PHP array
        $books = json_decode(file_get_contents(database_path().'/books.json'), True);

        # Initiate a new timestamp we can use for created_at/updated_at fields
        $timestamp = Carbon\Carbon::now()->subDays(count($books));

        foreach($books as $title => $book) {

            # First, figure out the id of the author we want to associate with this book

            # Extract just the last name from the book data...
            # F. Scott Fitzgerald => ['F.', 'Scott', 'Fitzgerald'] => 'Fitzgerald'
            $name = explode(' ', $book['author']);
            $lastName = array_pop($name);

            # Find that author in the authors table
            $author_id = Author::where('last_name', '=', $lastName)->pluck('id')->first();

            # Set the created_at/updated_at for each book to be one day less than
            # the book before. That way each book will have unique timestamps.
            $timestampForThisBook = $timestamp->addDay()->toDateTimeString();
            Book::insert([
                'created_at' => $timestampForThisBook,
                'updated_at' => $timestampForThisBook,
                'title' => $title,
                'author_id' => $author_id,
                'published' => $book['published'],
                'cover' => $book['cover'],
                'purchase_link' => $book['purchase_link'],
            ]);
        }
    }
}
