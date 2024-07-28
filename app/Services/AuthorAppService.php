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
        return AuthorResource::collection(Author::paginate(5));
    }


    public function get($id)
    {
        return AuthorResource::make(Author::findOrFail($id));
    }

    public function save($authorDto)
    {
        $author = Author::create($authorDto);
        return AuthorResource::make($author);
    }

    public function update($request, Author $author)
    {
        $author->update($request);
        return AuthorResource::make($author);
    }

    public function delete(Author $author)
    {
        $author->delete();
    }
}
