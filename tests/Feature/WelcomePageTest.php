<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    public $guest_response, $user_response, $admin_response;

    public function setUp() : void 
    {
        parent::setUp();

        $this->guest_response = $this->get('/');

        $this->user_response = $this->actingAs($this->user)->get('/');

        $this->admin_response = $this->actingAs($this->admin)->get('/');
    }

    public function test_welcome_page()
    {
        $response = $this->get('/');       

        $response->assertStatus(200);

        $response->assertSee("Welcome to LaraRe");

        $response->assertSee('<a class="text-whitehite" href="http://localhost">LaraRe</a>', false); 
    }

    public function test_guest_see_register_now() {
        $this->guest_response->assertSee("Register Now");
    }

    public function test_guest_can_not_see_start_browsing() {
        $this->guest_response->assertDontSee("Start browsing");
    }

    public function test_user_can_see_start_browsing() {
        $this->user_response->assertSee("Start browsing");
    }

    public function test_admin_can_see_admin_option() {
        $str = 'rounded-lg text-base font-semibold" aria-current="page">Administration';
        $this->admin_response->assertSee($str, false);
    }

    public function test_no_admin_can_not_see_admin_option() {
        $str = 'rounded-lg text-base font-semibold" aria-current="page">Administration';
        
        $this->guest_response->assertDontSee($str, false);

        $this->user_response->assertDontSee($str, false);
    }

}
