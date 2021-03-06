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

        //Arrange
        //建立一個代替mock的GuzzleClient來做驗證
        $guzzleClient = m::mock(new GuzzleClient);

        //呼叫request()，回傳Response物件，只執行一次
        $guzzleClient->shouldReceive('request')->andReturn(
            new Response('200', [], file_get_contents(__DIR__.'/result.txt'))
        )->once();

        //Act
        //建立一個代替mock的log class來做驗證
        $log = m::spy(Log::class);

       //建立Services/Client的物件，參數帶guzzleClient、log、key
        $client = new Client($guzzleClient, $log, $key);

        //client物件執行query()，參數帶BTC並且用json_encode，將回傳的array轉成String
        $json = json_encode($client->query('BTC'));

        //建立test變數將自己設的假的array資料，用json_encode轉成String
        $test = json_encode([
            'price' => 9165.74788036,
            'volume_24h' => 15782991288.054,
            'percent_change_1h' => -0.537992,
            'percent_change_24h' => -1.19578,
            'percent_change_7d' => 16.4927,
            'market_cap' => 162835578819.6922,
            'last_updated' => '2019-06-18T12:14:22.000Z',
        ]);

        //Assert
        //將client物件跟自己設定假資料做比對，確認內容有沒有一樣
        $this->assertEquals($json, $test);

        //驗證Services的Log有沒有info 這個function，帶key參數，並且執行一次
        $log->shouldHaveReceived('info')->with($key)->once();
    }
}
