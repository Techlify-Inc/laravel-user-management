<?php
namespace TechlifyInc\LaravelUserManagement\Traits;

/**
 * Trait that adds functionality to the user class
 *
 * @author 
 */
trait LaravelUserManagement
{

    public function findForPassport($username)
    {
        return $this->where('email', $username)
                ->where("enabled", true)
                ->first();
    }
}
