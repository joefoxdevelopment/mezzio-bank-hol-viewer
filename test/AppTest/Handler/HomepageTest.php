<?php

declare(strict_types=1);

namespace App\Test\Handler;

use App\BankHols\Get as BankHolsGet;
use App\Handler\Homepage;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomepageTest extends TestCase
{
    private $homepage;
    private $template;
    private $bankHolsGet;

    public function setUp(): void
    {
        $this->template    = $this->prophesize(TemplateRendererInterface::class);
        $this->bankHolsGet = $this->prophesize(BankHolsGet::class);

        $this->homepage = new Homepage(
            $this->template->reveal(),
            $this->bankHolsGet->reveal()
        );
    }

    public function testImplementsRequestHandlerInterface(): void
    {
        $this->assertInstanceOf(RequestHandlerInterface::class, $this->homepage);
    }

    public function testHandleReturnsHtmlResponse(): void
    {
        $this->bankHolsGet->getBankHols()
            ->shouldBeCalledOnce()
            ->willReturn(['bank-hols']);

        $this->template->render('app::home', ['bankHols' => ['bank-hols']])
            ->shouldBeCalledOnce()
            ->willReturn('<html>');

        $response = $this->homepage->handle(
            ($this->prophesize(ServerRequestInterface::class))->reveal()
        );

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
