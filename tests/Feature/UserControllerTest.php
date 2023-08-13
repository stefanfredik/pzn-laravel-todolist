<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PhpParser\Node\Expr\PostDec;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "fredik"
        ])->get("/login")->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post("/login", [
            'user'      => 'fredik',
            'password'  => 'rahasia'
        ])->assertRedirect("/")->assertSessionHas("user", "fredik");
    }

    public function testLoginAlreadyLogin()
    {
        $this->withSession(["user" => "fredik"])->post("/login", [
            'user'      => 'fredik',
            'password'  => 'rahasia'
        ])->assertRedirect("/")->assertSessionHas("user", "fredik");
    }

    function testLoginValidationError()
    {
        $this->post("/login", [])->assertSeeText("User or Password is required");
    }

    function testLoginFailed()
    {
        $this->post("/login", [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or Password Wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "fredik"
        ])->post("/logout")->assertRedirect("/")->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')->assertRedirect("/");
    }
}
