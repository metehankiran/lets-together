<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Board::create([
            'channel' => 'Main Board',
            'slug' => 'main-board',
            'description' => 'Let\'s Together\'s main board. This is where the magic happens.',
            'width' => 45,
            'height' => 20,
            'timer' => 5,
            'background' => '#fff',
        ]);
    }
}
