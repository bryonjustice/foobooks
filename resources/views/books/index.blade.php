@extends('layouts.master')

@push('head')
    <link href='/css/books.css' rel='stylesheet'>
@endpush

@section('title')
    Books
@endsection

@section('content')

    <section id='newBooks'>
        <h2>Latest additions to the Foobooks library</h2>
        <ul>
        @foreach($newBooks as $book)
            {{-- Note: diffForHumans is a built in method available to Carbon timestamps, read more here: http://carbon.nesbot.com/docs/ --}}
            <li class='truncate'><a href='/books/{{ $book->id }}'>{{ $book->title }}</a> added {{ $book->created_at->diffForHumans()}}</li>
        @endforeach
        </ul>
    </section>

    <section id='books' class='cf'>
        <h2>All books</h2>
        @foreach($books as $book)

            <div class='book cf'>

                <a href='/books/{{ $book->id }}'><img class='cover' src='{{ $book->cover }}' alt='Cover for {{ $book->title }}'></a>

                <a href='/books/{{ $book->id }}'><h3>{{ $book->title }}</h3></a>

                <a class='bookAction' href='/books/edit/{{ $book->id }}'><i class='fa fa-pencil'></i></a>
                <a class='bookAction' href='/books/{{ $book->id }}'><i class='fa fa-eye'></i></a>
                <a class='bookAction' href='/books/delete/{{ $book->id }}'><i class='fa fa-trash'></i></a>

            </div>
        @endforeach
    </section>

@endsection
