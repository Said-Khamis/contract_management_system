<?php namespace Tests\Repositories;

use App\Models\Institution;
use App\Repositories\InstitutionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InstitutionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InstitutionRepository
     */
    protected InstitutionRepository $institutionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->institutionRepo = \App::make(InstitutionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_institution()
    {
        $institution = Institution::factory()->make()->toArray();

        $createdInstitution = $this->institutionRepo->create($institution);

        $this->assertArrayHasKey('id', $createdInstitution);
        $this->assertNotNull($createdInstitution['id'], 'Created Institution must have id specified');
        $this->assertNotNull(Institution::find($createdInstitution['id']), 'Institution with given id must be in DB');
        $this->assertModelExists($createdInstitution);
    }

    /**
     * @test read
     */
    public function test_read_institution()
    {
        $institution = Institution::factory()->create();

        $dbInstitution = $this->institutionRepo->find($institution->id);

        $dbInstitution = $dbInstitution->toArray();
        $this->assertModelData($institution->toArray(), $dbInstitution);
    }

    /**
     * @test update
     */
    public function test_update_institution()
    {
        $institution = Institution::factory()->create();
        $fakeInstitution = Institution::factory()->make()->toArray();

        $updatedInstitution = $this->institutionRepo->update($fakeInstitution, $institution->id);

        $this->assertModelData($fakeInstitution, $updatedInstitution->toArray());
        $dbInstitution = $this->institutionRepo->find($institution->id);
        $this->assertModelData($fakeInstitution, $dbInstitution->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_institution()
    {
        $institution = Institution::factory()->create();

        $resp = $this->institutionRepo->delete($institution->id);

        $this->assertTrue($resp);
        $this->assertNull(Institution::find($institution->id), 'Institution should not exist in DB');
    }

}
