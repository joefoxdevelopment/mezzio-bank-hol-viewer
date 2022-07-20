<?php

declare(strict_types=1);

namespace App\Handler;

use App\BankHols\Get as BankHolsGet;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Homepage implements RequestHandlerInterface
{
    private $template;
    private $bankHols;

    public function __construct(TemplateRendererInterface $template, BankHolsGet $bankHols)
    {
        $this->template = $template;
        $this->bankHols = $bankHols;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse('<html><body><h1>Hello There</h1><pre>' . json_encode($this->bankHols->getBankHols(), JSON_PRETTY_PRINT) . '</pre></body></html>');
    }
}
