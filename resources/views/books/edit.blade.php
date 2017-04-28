{{-- /resources/views/books/new.blade.php --}}
@extends('layouts.master')

@section('title')
    Edit book: {{ $book->title }}
@endsection

@push('head')
    <link href='/css/edit.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Edit</h1>
    <h2>{{ $book->title }}</h2>

    <form method='POST' action='/books/edit'>
        {{ csrf_field() }}

        <p>* Required fields</p>

        <input type='hidden' name='id' value='{{$book->id}}'>

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title', $book->title) }}'>

        <label for='published'>* Published Year</label>
        <input type='text' name='published' id='published' value='{{ old('published', $book->published) }}'>

        <label for='cover'>* URL to a cover image</label>
        <input type='text' name='cover' id='cover' value='{{ old('cover', $book->cover) }}'>

        <label for='purchase_link'>* Purchase link</label>
        <input type='text' name='purchase_link' id='purchase_link' value='{{ old('purchase_link', $book->purchase_link) }}'>

        <label for='author_id'>* Author:</label>
        <select id='author_id' name='author_id'>
            @foreach($authorsForDropdown as $author_id => $authorName)
                <option value='{{ $author_id }}' {{ ($book->author_id == $author_id) ? 'SELECTED' : '' }}>
                    {{ $authorName }}
                </option>
            @endforeach
        </select>

        <label>Tags</label>
        <ul>
            @foreach($tagsForCheckboxes as $id => $name)
                <li><input
                    type='checkbox'
                    value='{{ $id }}'
                    id='tag_{{$id}}'
                    name='tags[]'
                    {{ (in_array($name, $tagsForThisBook)) ? 'CHECKED' : '' }}
                >&nbsp;
                <label for='tag_{{$id}}'>{{ $name }}</label></li>
            @endforeach
        </ul>

        <br><input class='btn btn-primary' type='submit' value='Save changes'><br><br>

    </form>


    @if(count($errors) > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection
