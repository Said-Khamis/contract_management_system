<?php namespace Tests\Repositories;

use App\Models\Sector;
use App\Models\User;
use App\Repositories\SectorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractSectorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SectorRepository
     */
    protected $contractSectorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractSectorRepo = \App::make(SectorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contract_sector()
    {
        $contractSector = Sector::factory()->make()->toArray();

        $createdContractSector = $this->contractSectorRepo->create($contractSector);

        $this->assertArrayHasKey('id', $createdContractSector);
        $this->assertNotNull($createdContractSector['id'], 'Created ContractSector must have id specified');
        $this->assertNotNull(Sector::find($createdContractSector['id']), 'ContractSector with given id must be in DB');
        $this->assertModelExists($createdContractSector);
    }

    /**
     * @test read
     */
    public function test_read_contract_sector()
    {
        $contractSector = Sector::factory()->create();

        $dbContractSector = $this->contractSectorRepo->find($contractSector->id);

        $this->assertModelExists($dbContractSector);
    }

    /**
     * @test update
     */
    public function test_update_contract_sector()
    {
        $contractSector = Sector::factory()->create();
        $fakeContractSector = Sector::factory()->make()->toArray();

        $updatedContractSector = $this->contractSectorRepo->update($fakeContractSector, $contractSector->id);

        $this->assertModelExists($updatedContractSector);
        $dbContractSector = $this->contractSectorRepo->find($contractSector->id);
        $this->assertModelExists($dbContractSector);
    }

    /**
     * @test delete
     */
    public function test_delete_contract_sector()
    {
        $contractSector = Sector::factory()->create();

        $resp = $this->contractSectorRepo->delete($contractSector->id);

        $this->assertTrue($resp);
        $this->assertNull(Sector::find($contractSector->id), 'ContractSector should not exist in DB');
    }
}
