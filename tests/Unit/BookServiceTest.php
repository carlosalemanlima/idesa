<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\BookAppService;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Carbon\Carbon;

class BookServiceTest extends TestCase
{

    use RefreshDatabase;

    protected $bookService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bookService = $this->app->make(BookAppService::class);
    }


    public function test_it_can_get_all_books_paginated()
    {

        //Arrange
        Book::factory()->count(25)->create();

        //Act
        $result = $this->bookService->getAll();

        //Assert
        $this->assertInstanceOf(\Illuminate\Http\Resources\Json\AnonymousResourceCollection::class, $result);
        $this->assertInstanceOf(\Illuminate\Http\Resources\Json\JsonResource::class, $result->collection->first());

        $this->assertEquals(5, $result->resource->perPage());
        $this->assertEquals(25, $result->resource->total());
        $this->assertEquals(5, $result->resource->lastPage());

        $this->assertCount(5, $result->resource->items());
    }


    public function test_it_can_get_a_single_book_by_id()
    {
        //Arrange
        $book = Book::factory()->create();

        //Act
        $result = $this->bookService->get($book->id);

        //Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(BookResource::class, $result);
        $this->assertEquals($book->id, $result->id);
    }


    public function test_it_can_save_a_book()
    {
        //Arrange
        $bookData = Book::factory()->make()->toArray();
        $bookData['published_date'] = Carbon::parse($bookData['published_date'])->toDateTimeString();

        //Act
        $book = $this->bookService->save($bookData);

        //Assert
        $this->assertInstanceOf(BookResource::class, $book);
        $this->assertDatabaseHas('books', $bookData);
    }


    public function test_it_can_update_a_book()
    {
        //Arrange
        $book = Book::factory()->create();
        $id =  $book->id;
        $originalTitle = $book->title;

        $updatedBookData = [
            'id' =>  $book->id,
            'title' => 'updated title',
            'isbn' => $book->isbn,
            'published_date' => Carbon::parse($book->published_date)->toDateTimeString(),
            'author_id' => $book->author->id
        ];

        //Act
        $updatedBook= $this->bookService->update($updatedBookData, $book);

        //Assert
        $this->assertInstanceOf(BookResource::class, $updatedBook);
        $this->assertDatabaseHas('books', $updatedBookData);
        $this->assertDatabaseMissing('books', [
            'id' => $id,
            'title' => $originalTitle,
        ]);
    }


    public function test_it_can_delete_a_book()
    {
        //Arrange
        $book = Book::factory()->create();

        //Act
        $this->bookService->delete($book);

        //Assert
        $this->assertModelMissing($book);
    }

}
