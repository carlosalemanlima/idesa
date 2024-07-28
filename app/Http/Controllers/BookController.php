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
        return response()->json($this->booksService->save($request), 201);
    }


    public function show(string $id)
    {
        return $this->booksService->get($id);
    }


    public function update(UpdateBookRequest $request, Book $book)
    {
        return $this->booksService->update($request, $book);
    }

    public function destroy(Book $book)
    {
        $this->booksService->delete($book);
        return response()->noContent();
    }
}
