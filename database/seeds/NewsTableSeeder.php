<?php

namespace Database\Seeders;

use App\News;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::factory()->count(4)->hasTags(2)->create();
    }
}
