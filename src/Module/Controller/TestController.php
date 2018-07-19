<?php

namespace Fabstract\Component\SimpleRestApplication\Module\Controller;

use Fabstract\Component\Http\Bag\EndpointBag;
use Fabstract\Component\Http\ControllerBase;

class TestController extends ControllerBase
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
