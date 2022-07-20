<?php

declare(strict_types=1);

namespace App\BankHols;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;

class Get
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getBankHols(): array
    {
        $request = new Request('GET', 'bank-holidays.json');

        $response = $this->client->sendRequest($request);

        return json_decode($response->getBody()->__toString(), true, 512);
    }
}
