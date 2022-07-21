<?php

declare(strict_types=1);

namespace App\Test\Http;

use App\Http\GovUkClientFactory;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class GovUkCLientFactoryTest extends TestCase
{
    private $factory;
    private $container;

    public function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->factory = new GovUkClientFactory();
    }

    public function testInvokeReturnsClient(): void
    {
        $client = ($this->factory)($this->container->reveal());

        $this->assertInstanceOf(Client::class, $client);
        $this->assertEquals('https://www.gov.uk', $client->getConfig()['base_uri']);
        $this->assertEquals(10, $client->getConfig()['timeout']);
    }
}
