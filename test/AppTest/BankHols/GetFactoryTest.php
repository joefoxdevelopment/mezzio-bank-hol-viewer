<?php

declare(strict_types=1);

namespace App\Test\BankHols;

use App\BankHols\Get;
use App\BankHols\GetFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;

class GetFactoryTest extends TestCase
{
    private $factory;
    private $client;
    private $container;

    public function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->client    = $this->prophesize(ClientInterface::class);

        $this->factory = new GetFactory();
    }

    public function testInvokeReturnsBankHolsGet(): void
    {
        $this->container->get('GovUkClient')
            ->willReturn($this->client->reveal());

        $bankHolsGet = ($this->factory)($this->container->reveal());

        $this->assertInstanceOf(Get::class, $bankHolsGet);
    }
}
