<?php

namespace App\Http\Controllers;

use App\Models\Author;

use Illuminate\Http\JsonResponse;
use App\Services\AuthorAppService;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{

    protected $authorsService;

    public function __construct(AuthorAppService $authorsService)
    {
        $this->authorsService = $authorsService;
    }

    public function index()
    {
        return $this->authorsService->getAll();
    }

    public function show($id)
    {
        return $this->authorsService->get($id);
    }

    public function store(StoreAuthorRequest $request): JsonResponse
    {
        return response()->json($this->authorsService->save($request->validated()), 201);
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        return $this->authorsService->update($request->validated(), $author);
    }

    public function destroy(Author $author)
    {
        $this->authorsService->delete($author);
        return response()->noContent();
    }
}