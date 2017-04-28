@extends('layouts.master')

@push('head')
    <link href='/css/books.css' rel='stylesheet'>
@endpush

@section('title')
    {{ $book->title }}
@endsection

@section('content')

    <div class='book cf'>

        <h1>{{ $book->title }}</h1>

        <a href='/books/{{ $book->id }}'><img class='cover' src='{{ $book->cover }}' alt='Cover for {{ $book->title }}'></a>

        <p>Published: {{ $book->published}}</p>

        <p>Added on: {{ $book->created_at }}</p>

        <p>Last updated: {{ $book->updated_at }}</p>

        <p><a href='{{$book->purchase_link}}'>Purchase this book...</a></p>

        <a class='bookAction' href='/books/edit/{{ $book->id }}'><i class='fa fa-pencil'></i></a>
        <a class='bookAction' href='/books/{{ $book->id }}/delete'><i class='fa fa-trash'></i></a>

    </div>
@endsection
