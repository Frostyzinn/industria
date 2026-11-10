<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;

class BancoDeTestesTest extends TestCase
{
    #[Test]
    public function exibe_nome_banco_de_dados(){
        $this->assertSame('industria',DB::connection()->getDatabaseName());
    }
}
