<?php

declare(strict_types=1);

namespace App\Handler;

use App\BankHols\Get;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;


class HomepageFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->get(TemplateRendererInterface::class);
        $bankHols = $container->get(Get::class);

        return new Homepage($template, $bankHols);
    }
}
