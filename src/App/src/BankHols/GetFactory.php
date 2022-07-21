<?php

declare(strict_types=1);

namespace App\BankHols;

use GuzzleHttp\Psr7\Request;
use Interop\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;

class GetFactory
{
    public function __invoke(ContainerInterface $container): Get
    {
        /** @var ClientInterface */
        $client = $container->get('GovUkClient');

        return new Get($client);
    }
}
