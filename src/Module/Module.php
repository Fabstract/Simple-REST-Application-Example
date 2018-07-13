<?php

namespace Fabstract\Component\SimpleRestApplication\Module;

use Fabstract\Component\DependencyInjection\ServiceProviderInterface;
use Fabstract\Component\Http\ModuleBase;
use Fabstract\Component\Http\ResourceProviderInterface;

class Module extends ModuleBase
{

    /**
     * @return ResourceProviderInterface|string
     */
    public function getResourceProvider()
    {
        return ResourceProvider::class;
    }

    /**
     * @return ServiceProviderInterface|string|null
     */
    public function getServiceProvider()
    {
        return null;
    }
}
