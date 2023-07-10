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
        if(isset($id)) {
            $newsList = [];
            for($i=0; $i<10; $i++){
                $newsList[$i] = [
                    'id' => $faker->randomDigitNotNull(),
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
                'newsList' => $newsList
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
        $newsList = [];
        $faker = Factory::create();
        if(isset($id)) {
            return [
                'id' => $faker->randomDigitNotNull(),
                'category_id' => $faker->randomDigitNotNull(),
                'title' => $faker->jobTitle(),
                'author' => $faker->userName(),
                'status' => 'DRAFT',
                'description' => $faker->text(100),
                'created_at' => now('Europe/Moscow')
            ];
        }
        for($i=0; $i<10; $i++){
            $newsList[$i] = [
                'id' => $faker->randomDigitNotNull(),
                'category_id' => $faker->randomDigitNotNull(),
                'title' => $faker->jobTitle(),
                'author' => $faker->userName(),
                'status' => 'DRAFT',
                'description' => $faker->text(100),
                'created_at' => now('Europe/Moscow')
            ];
        }
        return $newsList;
    }
}
