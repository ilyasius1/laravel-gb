<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\NewsStatus;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('news')->insert($this->getData());
    }

    private function getData(): array
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => 'News# ' . $i,
                'author' => $faker->userName(),
                'image' => fake()->imageUrl(),
                'status' => NewsStatus::ACTIVE->value,
                'description' => $faker->realText(rand(100,200)),
            ];
        }
        return $data;
    }
}
