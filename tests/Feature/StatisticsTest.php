<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StatisticsTest extends TestCase
{
    public function test_getting_statistics(): void
    {
        Item::factory()->amazon()->count(3)->create();
        Item::factory()->zid()->count(4)->create();
        Item::factory()->steam()->count(1)->create();

        $response = $this->getJson('/statistics');

        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('statistics')->etc();
            $json->has('statistics', function (AssertableJson $json) {
                $json
                    ->whereType('count',  ['integer','double'])
                    ->whereType('price average',  ['integer','double'])
                    ->whereType('highest prices totals', 'string')
                    ->whereType('total price this month', ['integer','double'])
                ;
            });
        });
    }
}
