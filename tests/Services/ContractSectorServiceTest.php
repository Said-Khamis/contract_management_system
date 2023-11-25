<?php

namespace Services;

use App\Models\Category;
use App\Models\Contract;
use App\Models\Sector;
use App\Models\Institution;
use App\Services\SectorService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Throwable;

class ContractSectorServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected SectorService $sectorService;

    public function setUp(): void
    {
        parent::setUp();
        $this->sectorService = \App::make(SectorService::class);
    }


    /**
     * Test if a contract sector can be created
     * @return void
     * @throws Throwable
     */
    public function test_create_contract_sector() : void
    {
        $category = Category::factory()->create();

        $contract = Contract::factory()->make();
        $category->contracts()->save($contract);

        $institute = Institution::factory()->create();

        $sector = Sector::factory()->make()->toArray();
        $sector['contract_id'] = $contract->id;
        $sector['institution_id'] = $institute->id;

        $dbSector = $this->sectorService->createContractSector($sector);

        $this->assertArrayHasKey('id', $dbSector);
        $this->assertNotNull($dbSector['id'], 'Created sector must have id specified');
        $this->assertModelExists($dbSector);
    }

    /**
     * Test if a contract sector can be updated
     * @return void
     * @throws Throwable
     */
    public function test_update_contract_sector() : void
    {
        $fakeSector = Sector::factory()->make()->toArray();

        $category = Category::factory()->create();

        $contract = Contract::factory()->make();
        $category->contracts()->save($contract);

        $institute = Institution::factory()->create();

        $sector = Sector::factory()->make()->toArray();
        $sector['contract_id'] = $contract->id;
        $sector['institution_id'] = $institute->id;
        $sector = $this->sectorService->createContractSector($sector);

        $updatedSector = $this->sectorService->updateContractSector($fakeSector, $sector->id);

        $this->assertModelExists($updatedSector);
        $dbSector = $this->sectorService->getContractSector($sector->id);
        $this->assertModelExists($dbSector);
    }

    /**
     * Test if a contract sector area can be deleted
     * @return void
     * @throws Throwable
     */
    public function test_delete_contract_sector(): void
    {
        $category = Category::factory()->create();

        $contract = Contract::factory()->make();
        $category->contracts()->save($contract);

        $institute = Institution::factory()->create();

        $sector = Sector::factory()->make()->toArray();
        $sector['contract_id'] = $contract->id;
        $sector['institution_id'] = $institute->id;
        $sector = $this->sectorService->createContractSector($sector);

        $response = $this->sectorService->deleteContractSector($sector->id);

        $this ->assertTrue($response);
        $this->assertNull(Sector::find($sector->id), 'Contract Sector should not exist in database');

    }


    /**
     * Test reading all contract sector area from database
     * @return void
     */
    public function test_find_all()
    {
        $category = Category::factory()->create();

        $contract = Contract::factory()->make();
        $category->contracts()->save($contract);

        $institute = Institution::factory()->create();

        $sector = Sector::factory()->make()->toArray();
        $sector['contract_id'] = $contract->id;
        $sector['institution_id'] = $institute->id;

        $sector = $this->sectorService->createContractSector($sector);

        $dbSector = $this->sectorService->findAll();

        $this->assertCount(1, $dbSector, 'The count did not match');

        $this->assertModelData($sector->toArray(), $dbSector->first()->toArray());
    }
}
