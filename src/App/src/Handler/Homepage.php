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
    /** @var TemplateRendererInterface */
    private $template;

    /** @var BankHolsGet */
    private $bankHols;

    public function __construct(TemplateRendererInterface $template, BankHolsGet $bankHols)
    {
        $this->template = $template;
        $this->bankHols = $bankHols;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render('app::home', [
            'bankHols' => $this->bankHols->getBankHols(),
        ]));
    }
}
