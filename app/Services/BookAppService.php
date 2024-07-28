<?php

namespace App\Services;

use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookAppService
{


    public function getAll()
    {
        return BookResource::collection(Book::paginate(5));
    }


    public function get($id)
    {
        return BookResource::make(Book::findOrFail($id));
    }


    public function save($bookDto)
    {
        $book = Book::create($bookDto);
        return BookResource::make($book);
    }


    public function update($validatedData, Book $book)
    {
        $book->update($validatedData);
        return BookResource::make($book);
    }


    public function delete(Book $book)
    {
        $book->delete();
    }
}
