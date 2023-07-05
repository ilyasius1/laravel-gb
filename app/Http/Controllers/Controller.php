<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getCategories(int $id = null):array
    {
        $categories = [];
        $faker = Factory::create();
        if($id) {
            $news = [];
            for($i=0; $i<10; $i++){
                $news[$i] = [
                    'category_id' => $id,
                    'title' => $faker->jobTitle(),
                    'author' => $faker->userName(),
                    'status' => 'DRAFT',
                    'description' => $faker->text(100),
                    'created_at' => now('Europe/Moscow')
                ];
            }
            return [
                'id' => $id,
                'name' => $faker->jobTitle(),
                'created_at' => now('Europe/Moscow'),
                'news' => $news
            ];
        }
        for($i=0; $i<10; $i++){
            $categories[$i] = [
                'id' => $i,
                'name' => $faker->jobTitle(),
                'created_at' => now('Europe/Moscow')
            ];
        }
        return $categories;
    }

    public function getNews(int $id = null):array
    {
        $news = [];
        $faker = Factory::create();
        if($id) {
            return [
                'category_id' => $faker->randomDigitNotNull(),
                'title' => $faker->jobTitle(),
                'author' => $faker->userName(),
                'status' => 'DRAFT',
                'description' => $faker->text(100),
                'created_at' => now('Europe/Moscow')
            ];
        }
        for($i=0; $i<10; $i++){
            $news[$i] = [
                'category_id' => $faker->randomDigitNotNull(),
                'title' => $faker->jobTitle(),
                'author' => $faker->userName(),
                'status' => 'DRAFT',
                'description' => $faker->text(100),
                'created_at' => now('Europe/Moscow')
            ];
        }
        return $news;
    }
}
