<?php

namespace TechlifyInc\LaravelUserManagement;

use Illuminate\Support\Facades\Facade;

/**
 * Description of LaravelUserManagementFacade
 *
 * @author 
 */
class LaravelUserManagementFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'laravel-user-management';
    }

}
