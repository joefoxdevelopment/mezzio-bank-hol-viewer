<?php

declare(strict_types=1);

namespace App\Test\Handler;

use App\BankHols\Get as BankHolsGet;
use App\Handler\HomepageFactory;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomepageFactoryTest extends TestCase
{
    private $factory;
    private $container;
    private $template;
    private $bankHolsGet;

    public function setUp(): void
    {
        $this->container   = $this->prophesize(ContainerInterface::class);
        $this->template    = $this->prophesize(TemplateRendererInterface::class);
        $this->bankHolsGet = $this->prophesize(BankHolsGet::class);

        $this->factory = new HomepageFactory();
    }

    public function testInvokeReturnsHomepage(): void
    {
        $this->container->get(TemplateRendererInterface::class)
            ->willReturn($this->template->reveal());

        $this->container->get(BankHolsGet::class)
            ->willReturn($this->bankHolsGet->reveal());

        $homepage = ($this->factory)($this->container->reveal());

        $this->assertInstanceOf(RequestHandlerInterface::class, $homepage);
    }
}
