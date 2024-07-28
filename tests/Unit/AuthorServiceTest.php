<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\AuthorAppService;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use Carbon\Carbon;

class AuthorServiceTest extends TestCase
{

    use RefreshDatabase;

    protected $authorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authorService = new AuthorAppService();
    }


    public function test_it_can_get_all_authors_paginated()
    {

        //Arrange
        Author::factory()->count(25)->create();

        //Act
        $result = $this->authorService->getAll();

        //Assert
        $this->assertInstanceOf(\Illuminate\Http\Resources\Json\AnonymousResourceCollection::class, $result);
        $this->assertInstanceOf(\Illuminate\Http\Resources\Json\JsonResource::class, $result->collection->first());

        $this->assertEquals(5, $result->resource->perPage());
        $this->assertEquals(25, $result->resource->total());
        $this->assertEquals(5, $result->resource->lastPage());

        $this->assertCount(5, $result->resource->items());
    }


    public function test_it_can_get_a_single_author_by_id()
    {
        //Arrange
        $author = Author::factory()->create();

        //Act
        $result = $this->authorService->get($author->id);

        //Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(AuthorResource::class, $result);
        $this->assertEquals($author->id, $result->id);
    }


    public function test_it_can_save_an_author()
    {
        //Arrange
        $authorData = Author::factory()->make()->toArray();
        $authorData['birthdate'] = Carbon::parse($authorData['birthdate'])->toDateTimeString();

        //Act
        $author = $this->authorService->save($authorData);

        //Assert
        $this->assertInstanceOf(AuthorResource::class, $author);
        $this->assertDatabaseHas('authors', $authorData);
    }


    public function test_it_can_update_an_author()
    {
        //Arrange
        $author = Author::factory()->create();
        $id =  $author->id;
        $originalName = $author->name;


        $updatedAuthorData = [
            'id' =>  $author->id,
            'name' => 'updated name',
            'nationality' => $author->nationality,
            'birthdate' => Carbon::parse($author->birthdate)->toDateTimeString()
        ];

        //Act
        $updatedAuthor = $this->authorService->update($updatedAuthorData, $author);

        //Assert
        $this->assertInstanceOf(AuthorResource::class, $updatedAuthor);
        $this->assertDatabaseHas('authors', $updatedAuthorData);
        $this->assertDatabaseMissing('authors', [
            'id' => $id,
            'name' => $originalName,
        ]);
    }


    public function test_it_can_delete_an_author()
    {
        //Arrange
        $author = Author::factory()->create();

        //Act
        $this->authorService->delete($author);

        //Assert
        $this->assertModelMissing($author);
    }

}
