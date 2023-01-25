<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $users, $admin, $user;

    public function setUp() : void 
    {
        parent::setUp();
        
        $this->users = User::factory(10)->create();

        $this->user = $this->users->first();

        $this->admin = User::factory()->create(['isAdmin' => 1]);
    }

}
