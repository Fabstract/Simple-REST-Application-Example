<?php

namespace Fabstract\Component\SimpleRestApplication\App;

use Fabstract\Component\Http\Bag\ModuleBag;
use Fabstract\Component\REST\RestApplication;
use Fabstract\Component\SimpleRestApplication\Module\Module;

class Application extends RestApplication
{

    /**
     * @param ModuleBag $module_bag
     * @return void
     */
    protected function configureModuleBag($module_bag)
    {
        $module_bag->create('/', Module::class);
    }
}
