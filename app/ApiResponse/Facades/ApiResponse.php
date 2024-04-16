<?php
namespace App\ApiResponse\Facades;

use Illuminate\Support\Facades\Facade;

class ApiResponse extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'apiResponse';
    }


}
