<?php 
namespace Grdar\core\Facades;

use  Grdar\core\Facades\Facade;

class View extends Facade
{
    public static function getAccessor()
    {
        return 'View';
    }
}
