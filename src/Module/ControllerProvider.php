<?php

namespace Fabstract\Component\SimpleRestApplication\Module;

use Fabstract\Component\Http\Bag\ControllerBag;
use Fabstract\Component\Http\ControllerProviderBase;
use Fabstract\Component\SimpleRestApplication\Module\Controller\TestController;

class ControllerProvider extends ControllerProviderBase
{

    /**
     * @param ControllerBag $controller_bag
     * @return void
     */
    public function configureControllerBag($controller_bag)
    {
        $controller_bag->create('/test', TestController::class);
    }
}
