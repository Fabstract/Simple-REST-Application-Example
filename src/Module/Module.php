<?php

namespace Fabstract\Component\SimpleRestApplication\Module;

use Fabstract\Component\DependencyInjection\ServiceProviderInterface;
use Fabstract\Component\Http\ControllerProviderInterface;
use Fabstract\Component\Http\ModuleBase;

class Module extends ModuleBase
{

    /**
     * @return ControllerProviderInterface|string
     */
    public function getControllerProvider()
    {
        return ControllerProvider::class;
    }

    /**
     * @return ServiceProviderInterface|string|null
     */
    public function getServiceProvider()
    {
        return null;
    }
}
