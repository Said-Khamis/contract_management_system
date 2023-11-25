<?php

namespace Services;

use App\Models\Ward;
use App\Services\WardService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Throwable;

class WardServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected WardService $wardService;

    public function setUp() : void
    {
        parent::setUp();
        $this->wardService = \App::make(WardService::class);
    }

    public function test_find_all()
    {
        //Required that ward exist
        $ward = Ward::factory()->create();

        //when ward are fetched
        $dbWard= $this->wardService->findAll();
        $this->assertNotNull($dbWard);
    }

    /**
     * @throws Throwable
     */
    public function test_create_ward()
    {
        $ward = Ward::factory()->make()->toArray();

        $createdWard = $this->wardService->createWard($ward);

        $createdWard = $createdWard->toArray();
        $this->assertArrayHasKey('id', $createdWard);
        $this->assertNotNull($createdWard['id'], 'Created Ward must have id specified');
        $this->assertNotNull(Ward::find($createdWard['id']), 'Ward with given id must be in DB');
    }

    public function test_read_ward(){
        $ward = Ward::factory()->create();

        $dbWard = $this->wardService->getWard($ward->id);

        $dbWard = $dbWard->toArray();
        $this->assertModelData($ward->toArray(), $dbWard);
    }

    /**
     * @throws Throwable
     */
    public function test_update_ward(){
        $ward = Ward::factory()->create();
        $fakeWard = Ward::factory()->make()->toArray();

        $updatedWard = $this->wardService->updateWard($fakeWard, $ward->id);

        $this->assertModelData($fakeWard, $updatedWard->toArray());
        $dbWard = $this->wardService->getWard($ward->id);
        $this->assertModelData($fakeWard, $dbWard->toArray());
    }

    /**
     * @throws Throwable
     */
    public function test_delete_ward(): void
    {
        $ward =  Ward::factory()->create();

        $response = $this->wardService->deleteWard($ward->id);

        $this->assertTrue($response);
        $this->assertNull(Ward::find($ward->id), 'Ward should not exist in DB');
    }

}
