<?php

namespace App\Http;

use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

class GovUkClientFactory
{
    private const GOV_UK_BASE_URI = 'https://www.gov.uk';

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container): Client
    {
        return new Client([
            'base_uri' => self::GOV_UK_BASE_URI,
            'timeout'  => 10,
        ]);
    }
}
