<?php

namespace Tests\Services;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CategoryServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected CategoryService $categoryService;

    public function setUp() : void
    {
        parent::setUp();
        $this->categoryService = \App::make(CategoryService::class);
    }
    public function test_find_all()
    {
        //Required that category exist
        $category = Category::factory()->create();

        //when category are fetched
        $dbCategory = $this->categoryService->findAll();

        //the created count must be same as expected
        $this->assertDatabaseCount('categories', 1);

        //created model must resemble fetched model
        $this->assertModelData($category->toArray(), $dbCategory->first()->toArray());
    }

    /**
     * @throws \Throwable
     */
    public function test_create_category()
    {
        $category = Category::factory()->make()->toArray();

        $dbCategory = $this->categoryService->createCategory($category);

        $this->assertArrayHasKey('id', $dbCategory);
        $this->assertNotNull($dbCategory['id'], 'Created Category must have id specified');
        $this->assertModelExists($dbCategory);

    }

    public function test_show_category(){
        $category = Category::factory()->create();
        $retrievedCategory = $this->categoryService->getCategory($category->id);
        // Assert that the retrieved category matches the test category
        $this->assertEquals($category->id, $retrievedCategory->id);
        $this->assertEquals($category->name, $retrievedCategory->name);

    }

    /**
     * @throws \Throwable
     */
    public function test_update_category(){
        $category = Category::factory()->create();
        $fakeCategory = Category::factory()->make()->toArray();

        $updatedCategory = $this->categoryService->updateCategory($fakeCategory, $category->id);

        $this->expectsDatabaseQueryCount(2);
        $this->assertDatabaseCount('categories', 1);
        $this->assertModelExists($updatedCategory);
    }

    public function test_delete_category(){
        $category =  Category::factory()->create();

        $response = $this->categoryService->deleteCategory($category->id);

        $this->assertTrue($response);
        $this->assertNull($this->categoryService->getCategory($category->id), 'Category should not exist in DB');
    }



}
