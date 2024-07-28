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
        return BookResource::collection(Book::paginate(10));
    }


    public function get($id)
    {
        return BookResource::make(Book::findOrFail($id));
    }


    public function save(StoreBookRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['author_id'] = $validatedData['author']['author_id'];
        unset($validatedData['author']);

        $book = Book::create($validatedData);
        return BookResource::make($book);
    }


    public function update(UpdateBookRequest $request, Book $book)
    {
        $validatedData = $request->validated();

        if (isset($request['author'])) {
            $validatedData['author_id'] = $validatedData['author']['author_id'];
            unset($validatedData['author']);
        }

        $book->update($validatedData);
        return BookResource::make($book);
    }


    public function delete(Book $book)
    {
        $book->delete();
    }
}
