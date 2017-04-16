<?php

use Illuminate\Database\Seeder;

use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Book::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'published' => 1925,
            'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
        ]);

        Book::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'The Bell Jar',
            'author' => 'Sylvia Plath',
            'published' => 1963,
            'cover' => 'http://img1.imagesbn.com/p/9780061148514_p0_v2_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/bell-jar-sylvia-plath/1100550703?ean=9780061148514',
        ]);

        Book::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'I Know Why the Caged Bird Sings',
            'author' => 'Maya Angelou',
            'published' => 1969,
            'cover' => 'http://img1.imagesbn.com/p/9780345514400_p0_v1_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/i-know-why-the-caged-bird-sings-maya-angelou/1100392955?ean=9780345514400',
        ]);

        Book::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'author' => 'J.K. Rowling',
            'published' => 1997,
            'cover' => 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg',
            'purchase_link' => 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427',
        ]);

        Book::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'Harry Potter and the Chamber of Secrets',
            'author' => 'J.K. Rowling',
            'published' => 1998,
            'cover' => 'http://prodimage.images-bn.com/pimages/9780439064873_p0_v1_s192x300.jpg',
            'purchase_link' => 'http://www.barnesandnoble.com/w/harry-potter-and-the-chamber-of-secrets-j-k-rowling/1004338523?ean=9780439064873',
        ]);

        Book::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'Harry Potter and the The Prisoner of Azkaban',
            'author' => 'J.K. Rowling',
            'published' => 1999,
            'cover' => 'http://prodimage.images-bn.com/pimages/9780439136365_p0_v1_s192x300.jpg',
            'purchase_link' => 'http://www.barnesandnoble.com/w/harry-potter-and-the-prisoner-of-azkaban-j-k-rowling/1100178339?ean=9780439136365',
        ]);
    }
}
