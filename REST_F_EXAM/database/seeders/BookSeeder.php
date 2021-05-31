<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Book::firstOrCreate([
                'isbn' => '11111' . $i,
                'titre' => 'Titre ' . $i,
                'auteur' => 'Auteur ' . $i,
                'price' => 100 * $i
            ]);
        }
    }
}
