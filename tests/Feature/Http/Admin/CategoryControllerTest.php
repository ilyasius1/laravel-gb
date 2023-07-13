<?php

namespace Tests\Feature\Http\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessCategoriesList(): void
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }
}
