<?php

namespace Tests\Unit\Services;

use Mockery as m;
use App\Services\Log;
use App\Services\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;

class ClientTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    /** @test */
    public function test_query()
    {
        $key = '216c9611-9a19-44cd-9cc2-052d9fbcd761';
        $guzzleClient = m::mock(new GuzzleClient);
        $guzzleClient->shouldReceive('request')->andReturn(
            new Response('200', [], file_get_contents(__DIR__.'/result.txt'))
        )->once();
        $log = m::spy(Log::class);
        $client = new Client($guzzleClient, $log, $key);
        $json = json_encode($client->query('BTC'));

        
        $test = json_encode([
            'price' => 9165.74788036,
            'volume_24h' => 15782991288.054,
            'percent_change_1h' => -0.537992,
            'percent_change_24h' => -1.19578,
            'percent_change_7d' => 16.4927,
            'market_cap' => 162835578819.6922,
            'last_updated' => '2019-06-18T12:14:22.000Z',
        ]);

        $this->assertEquals($json, $test);

        $log->shouldHaveReceived('info')->with($key)->once();
    }
}
