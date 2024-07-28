<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookAppService;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{


    protected $booksService;

    public function __construct(BookAppService $booksService)
    {
        $this->booksService = $booksService;
    }


    public function index()
    {
        return $this->booksService->getAll();
    }

    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['author_id'] = $validatedData['author']['author_id'];
        unset($validatedData['author']);

        return response()->json($this->booksService->save($validatedData), 201);
    }


    public function show(string $id)
    {
        return $this->booksService->get($id);
    }


    public function update(UpdateBookRequest $request, Book $book)
    {
        $validatedData = $request->validated();

        if (isset($request['author'])) {
            $validatedData['author_id'] = $validatedData['author']['author_id'];
            unset($validatedData['author']);
        }

        return $this->booksService->update($validatedData, $book);
    }

    public function destroy(Book $book)
    {
        $this->booksService->delete($book);
        return response()->noContent();
    }
}
