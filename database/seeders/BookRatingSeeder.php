<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if ( ! empty(DB::table('book_ratings')->count())) {
            return;
        }

        DB::table('book_ratings')->insert([
            [ 
                'user_id' => 1,
                'book_id' => 1,
                'rating' => 0,
                'created_at' => DB::raw('NOW()'),
            ],
            [ 
                'user_id' => 1,
                'book_id' => 2,
                'rating' => 5,
                'created_at' => DB::raw('NOW()'),
            ],
            [ 
                'user_id' => 1,
                'book_id' => 3,
                'rating' => 3,
                'created_at' => DB::raw('NOW()'),
            ],
            [ 
                'user_id' => 1,
                'book_id' => 4,
                'rating' => 4,
                'created_at' => DB::raw('NOW()'),
            ],
            [ 
                'user_id' => 1,
                'book_id' => 5,
                'rating' => 5,
                'created_at' => DB::raw('NOW()'),
            ],
        ]);
    }
}
