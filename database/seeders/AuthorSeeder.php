<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Carbon\Carbon;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        if (Author::count() == 0) {
            $authors = [
                [
                    'name' => 'J.K. Rowling',
                    'nationality' => 'British',
                    'birthdate' => Carbon::parse('1965-07-31'),
                ],
                [
                    'name' => 'George R.R. Martin',
                    'nationality' => 'American',
                    'birthdate' => Carbon::parse('1948-09-20'),
                ],
                [
                    'name' => 'J.R.R. Tolkien',
                    'nationality' => 'British',
                    'birthdate' => Carbon::parse('1892-01-03'),
                ],
                [
                    'name' => 'Haruki Murakami',
                    'nationality' => 'Japanese',
                    'birthdate' => Carbon::parse('1949-01-12'),
                ],
                [
                    'name' => 'Agatha Christie',
                    'nationality' => 'British',
                    'birthdate' => Carbon::parse('1890-09-15'),
                ],
                [
                    'name' => 'Jane Austen',
                    'nationality' => 'British',
                    'birthdate' => Carbon::parse('1775-12-16'),
                ],
                [
                    'name' => 'Ernest Hemingway',
                    'nationality' => 'American',
                    'birthdate' => Carbon::parse('1899-07-21'),
                ],
                [
                    'name' => 'Mark Twain',
                    'nationality' => 'American',
                    'birthdate' => Carbon::parse('1835-11-30'),
                ],
                [
                    'name' => 'Gabriel Garcia Marquez',
                    'nationality' => 'Colombian',
                    'birthdate' => Carbon::parse('1927-03-06'),
                ],
                [
                    'name' => 'Leo Tolstoy',
                    'nationality' => 'Russian',
                    'birthdate' => Carbon::parse('1828-09-09'),
                ],
            ];

            foreach ($authors as $author) {
                Author::create($author);
            }
        }
    }
}
