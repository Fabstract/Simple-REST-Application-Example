<?php

namespace Fabstract\Component\SimpleRestApplication\Module\Resource;

use Fabstract\Component\Http\Bag\EndpointBag;
use Fabstract\Component\Http\ResourceBase;

class TestResource extends ResourceBase
{

    /**
     * @param EndpointBag $endpoint_bag
     * @return void
     */
    public function configureEndpointBag($endpoint_bag)
    {
        $endpoint_bag->create('/')
            ->addGET('get');
    }

    public function get()
    {
        return 'get';
    }
}
