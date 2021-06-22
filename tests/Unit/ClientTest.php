<?php

namespace Tests\Unit;

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
            new Response('200', [], file_get_contents(__DIR__.'/Services/result.txt'))
        )->once();
        $log = m::spy(Log::class);
        $client = new Client($guzzleClient, $log, $key);

        $this->assertJsonStructure($client->query('btC'));
    

        $log->shouldHaveReceived('info')->with($key)->once();
    }
}
