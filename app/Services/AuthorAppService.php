<?php

namespace App\Services;

use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorAppService
{


    public function getAll()
    {
        return AuthorResource::collection(Author::paginate(10));
    }


    public function get($id)
    {
        return AuthorResource::make(Author::findOrFail($id));
    }

    public function save(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        return AuthorResource::make($author);
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        return AuthorResource::make($author);
    }

    public function delete(Author $author)
    {
        $author->delete();
    }
}
