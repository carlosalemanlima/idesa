<?php

namespace App\Services;

use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

interface AuthorAppService
{
    function getAll();

    function get($id);

    function save($authorDto);

    function update($request, Author $author);

    function delete(Author $author);
}
