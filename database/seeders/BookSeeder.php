<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Carbon\Carbon;
use App\Models\Author;

class BookSeeder extends Seeder
{
    public function run()
    {
        if (Book::count() == 0) {
            $books = [
                [
                    'title' => 'Harry Potter and the Philosopher\'s Stone',
                    'isbn' => '9780747532699',
                    'published_date' => Carbon::parse('1997-06-26'),
                    'author_id' => Author::where('name', 'J.K. Rowling')->first()->id,
                ],
                [
                    'title' => 'A Game of Thrones',
                    'isbn' => '9780553103540',
                    'published_date' => Carbon::parse('1996-08-06'),
                    'author_id' => Author::where('name', 'George R.R. Martin')->first()->id,
                ],
                [
                    'title' => 'The Hobbit',
                    'isbn' => '9780345339683',
                    'published_date' => Carbon::parse('1937-09-21'),
                    'author_id' => Author::where('name', 'J.R.R. Tolkien')->first()->id,
                ],
                [
                    'title' => 'Norwegian Wood',
                    'isbn' => '9780375704024',
                    'published_date' => Carbon::parse('1987-09-04'),
                    'author_id' => Author::where('name', 'Haruki Murakami')->first()->id,
                ],
                [
                    'title' => 'Murder on the Orient Express',
                    'isbn' => '9780062693662',
                    'published_date' => Carbon::parse('1934-01-01'),
                    'author_id' => Author::where('name', 'Agatha Christie')->first()->id,
                ],
                [
                    'title' => 'Pride and Prejudice',
                    'isbn' => '9780141439518',
                    'published_date' => Carbon::parse('1813-01-28'),
                    'author_id' => Author::where('name', 'Jane Austen')->first()->id,
                ],
                [
                    'title' => 'The Old Man and the Sea',
                    'isbn' => '9780684801223',
                    'published_date' => Carbon::parse('1952-09-01'),
                    'author_id' => Author::where('name', 'Ernest Hemingway')->first()->id,
                ],
                [
                    'title' => 'Adventures of Huckleberry Finn',
                    'isbn' => '9780486280615',
                    'published_date' => Carbon::parse('1884-12-10'),
                    'author_id' => Author::where('name', 'Mark Twain')->first()->id,
                ],
                [
                    'title' => 'One Hundred Years of Solitude',
                    'isbn' => '9780060883287',
                    'published_date' => Carbon::parse('1967-06-05'),
                    'author_id' => Author::where('name', 'Gabriel Garcia Marquez')->first()->id,
                ],
                [
                    'title' => 'War and Peace',
                    'isbn' => '9780199232765',
                    'published_date' => Carbon::parse('1869-01-01'),
                    'author_id' => Author::where('name', 'Leo Tolstoy')->first()->id,
                ],
            ];

            foreach ($books as $book) {
                Book::create($book);
            }
        }
    }
}
