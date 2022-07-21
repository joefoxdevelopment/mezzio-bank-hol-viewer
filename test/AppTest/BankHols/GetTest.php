<?php

declare(strict_types=1);

namespace App\Test\BankHols;

use App\BankHols\Get as BankHolsGet;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetTest extends TestCase
{
    private $bankHolsGet;
    private $client;

    public function setUp(): void
    {
        $this->client = $this->prophesize(ClientInterface::class);

        $this->bankHolsGet = new BankHolsGet($this->client->reveal());
    }

    public function testGetBankHolsReturnsArrayOfBankHols(): void
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->__toString()->willReturn('{}');

        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $this->client->sendRequest(Argument::type(Request::class))
            ->willReturn($response->reveal());

        $result = $this->bankHolsGet->getBankHols();

        $this->assertEquals([], $result);
    }
}
