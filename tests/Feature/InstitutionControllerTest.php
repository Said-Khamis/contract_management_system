<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class InstitutionControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @throws AuthenticationException
     */
    public function testIndex()
    {
        $user = Auth::attempt(['email' => 'admin@fms.co.tz','password' => 'password']);
        $this->assertTrue($user);
        $response = $this->get('institutions');

        $response->assertStatus(200);
        $response->assertViewIs('institutions.index');
    }

    public function testCreate()
    {
        $user = Auth::attempt(['email' => 'admin@fms.co.tz','password' => 'password']);
        $this->assertTrue($user);
        $response = $this->get('institutions/create');

        $response->assertStatus(200);
        $response->assertViewIs('institutions.create');
       // $response->
    }





}
