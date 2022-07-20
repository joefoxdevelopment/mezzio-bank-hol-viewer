<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;
use function get_class;

class HomepageFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new Homepage($template);
    }
}
