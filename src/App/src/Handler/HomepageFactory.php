<?php

declare(strict_types=1);

namespace App\Handler;

use App\BankHols\Get as BankHolsGet;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomepageFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        /** @var TemplateRendererInterface */
        $template = $container->get(TemplateRendererInterface::class);

        /** @var BankHolsGet */
        $bankHols = $container->get(BankHolsGet::class);

        return new Homepage($template, $bankHols);
    }
}
