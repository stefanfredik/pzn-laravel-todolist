<?php

namespace Tests\Feature;

use App\Service\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodoListNotNull()
    {
        self::assertNotNull($this->todolistService);
    }


    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "Fredik");

        $todolist = Session::get("todolist");

        foreach ($todolist as $value) {
            self::assertEquals("1", $value["id"]);
            self::assertEquals("Fredik", $value["todo"]);
        }
    }


    public function testTodolistNotEmpty()
    {
        $excepted = [
            [
                "id"    => "1",
                "todo"  => "Fredik"
            ],
            [
                "id" => "2",
                "todo" => "Stefan"
            ]
        ];


        $this->todolistService->saveTodo("1", "Fredik");
        $this->todolistService->saveTodo("2", "Stefan");

        self::assertEquals($excepted, $this->todolistService->getTodoList());
    }


    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "Fredik");
        $this->todolistService->saveTodo("2", "Stefan");

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("3");
        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("1");
        Self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("2");
        self::assertEquals(0, sizeof($this->todolistService->getTodolist()));
    }
}
