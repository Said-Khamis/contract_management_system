<?php

namespace Tests\Services;

use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;


Class PersonServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected PersonService $personService;
    
    /**
     * @var PersonService
     */
    function setUp(): void
    {
        parent::setUp();
        $this->personService = \App::make(PersonService::class);
    }

    /**
     * @test find
     */
    public function test_find_all()
    {
        $person = Person::factory()->create();
        $dbPerson = $this->personService->findAll();
        $this->assertCount(1, $dbPerson);
        $this->assertModelData($person->toArray(), $dbPerson->first()->toArray());
    }

    /**
     * @test create
     */
    public function test_create_person()
    {
        $person = Person::factory()->create()->toArray();
        $dbPerson = $this->personService->createPerson($person);
        $this->assertArrayHasKey('id',$dbPerson);
        $this->assertNotNull($dbPerson['id'], 'Created Person must have id specified');
        $this->assertModelData($person, $dbPerson->first()->toArray());
    }

    /**
     * @test read
     */
    public function test_show_person()
    {
        $person = Person::factory()->create();
        $retrievedPerson = $this->personService->getPerson($person->id);
        $this->assertEquals($person->id, $retrievedPerson->id);
        $this->assertEquals($person->name, $retrievedPerson->name);
    }

    /**
     * @test update
     */
    public function test_update_person()
    {
        $person = Person::factory()->create();
        $fakePerson = Person::factory()->make()->toArray();
        $updatePerson = $this->personService->updatePerson($fakePerson, $person->id);
        $this->assertModelData($fakePerson, $updatePerson->toArray());
        $this->assertModelExists($updatePerson);
        $dbPerson = $this->personService->getPerson($person->id);
        $this->assertModelData($fakePerson, $dbPerson->toArray());
        
    }

    /**
     * @test delete
     */
    public function test_delete_person()
    {
        $person = Person::factory()->create();
        $deletePerson = $this->personService->deletePerson($person->id);
        $this->assertTrue($deletePerson);
        $this->assertSoftDeleted($person);
        $this->assertNull($this->personService->getPerson($person->id), 'Person should not exist in DB');
    }

}