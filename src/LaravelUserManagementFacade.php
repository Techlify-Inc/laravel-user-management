<?php

namespace TechlifyInc\LaravelUserManagement;

use Illuminate\Support\Facades\Facade;

/**
 * Description of LaravelRbacFacade
 *
 * @author 
 */
class LaravelUserManagementFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'laravel-rbac';
    }

}
