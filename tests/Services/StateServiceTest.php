<?php


use App\Models\state;
use App\Services\stateService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class StateServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected StateService $stateService;

    public function setUp() : void
    {
        parent::setUp();
        $this->stateService = \App::make(StateService::class);
    }
    public function test_find_all()
    {
        //Required that state exist
        $state = State::factory()->create();
        //when state are fetched
        $dbState = $this->stateService->findAll();
        //the created count must be same as expected
        $this->assertNotNull($dbState);
    }

    /**
     * @throws Throwable
     */
    public function test_create_state()
    {
        $state = State::factory()->make()->toArray();
        $dbState = $this->stateService->createState($state);
        $this->assertArrayHasKey('id', $dbState);
        $this->assertNotNull($dbState['id'], 'Created state must have id specified');
        $this->assertNotNull(state::find($dbState['id']), 'state with given id must be in DB');
        $this->assertModelData($state, $dbState->toArray());
    }

    public function test_read_country(){
        $state = State::factory()->create();
        $dbState = $this->stateService->getstate($state->id);
        $dbState = $dbState->toArray();
        $this->assertModelData($state->toArray(), $dbState);

    }

    /**
     * @throws Throwable
     */
    public function test_update_state(){
        $state = State::factory()->create();
        $fakeState = State::factory()->make()->toArray();
        $updatedState = $this->stateService->updatestate($fakeState, $state->id);
        $this->assertModelData($fakeState, $updatedState->toArray());
        $dbCountry = $this->stateService->getstate($state->id);
        $this->assertModelData($fakeState, $dbCountry->toArray());
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function test_delete_state(): void
    {
        $state =  State::factory()->create();

        $response = $this->stateService->deleteState($state->id);

        $this->assertTrue($response);
        $this->assertNull($this->stateService->getState($state->id), 'state should not exist in DB');
    }

}
