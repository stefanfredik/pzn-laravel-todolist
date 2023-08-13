<?php

namespace Tests\Feature;

use App\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }


    function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("fredik", "rahasia"));
    }

    function testLoginNotFound()
    {
        self::assertFalse($this->userService->login("fred", "rahasia"));
    }

    function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("fredik", "srahasia"));
    }
}
