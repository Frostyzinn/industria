<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Fabrica;
use PHPUnit\Framework\Atributes\DataProvider;
use PHPUnit\Framework\Atributes\Test;
use App\Models\User;
use Laravel\Sanctum\Sanctum;


class FabricaControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
    }


    #[Test]
    public function listar_fabrica() : void{
        $antes = Fabrica::count();
        Fabrica::factory()->count(3)->create();
        
        $this->getJson('/api/fabrica')->assertOk()->assertJsonCount(3);
   }
}
