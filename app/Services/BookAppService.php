<?php

namespace App\Services;

use App\Models\Book;
use App\Http\Resources\BookResource;

interface BookAppService
{

    function getAll();

    function get($id);

    function save($bookDto);

    function update($validatedData, Book $book);

    function delete(Book $book);
}
