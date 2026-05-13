<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::create([
            'category_id' => 1,
            'title' => 'PHP学習',
            'body' => 'phpの勉強を1時間します。',
            'is_done' => false,
            'user_id' => 1,
        ]);
        Todo::create([
            'category_id' => 2,
            'title' => 'SQL学習',
            'body' => 'sqlの勉強を1時間します。',
            'is_done' => false,
            'user_id' => 2,
        ]);
        Todo::create([
            'category_id' => 3,
            'title' => 'オブジェクト指向学習',
            'body' => 'オブジェクト指向の勉強を1時間します。',
            'is_done' => false,
            'user_id' => 3,
        ]);
    }
}
