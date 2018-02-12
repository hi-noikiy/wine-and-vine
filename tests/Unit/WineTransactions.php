<?php

namespace Tests\Unit;

use App\Wine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WineTransactions extends TestCase
{
    use RefreshDatabase;

    /** @test
     * @throws \Exception
     */
    public function a_wine_is_fetched_from_database_with_its_fields_capitalised()
    {
        factory(Wine::class)->create([
            'name' => ' weird  Looking  name ',
            'type' => ' weird  Looking  type ',
            'style' => ' weird  Looking  style ',
            'description' => ' A  very  whitespaced  description  !! ',
        ]);

        $wine = Wine::first();
        $this->assertEquals('Weird Looking Name', $wine->name);
        $this->assertEquals('Weird Looking Type', $wine->type);
        $this->assertEquals('Weird Looking Style', $wine->style);
        $this->assertEquals('A very whitespaced description !!', $wine->description);
    }
}
