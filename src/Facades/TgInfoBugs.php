<?php

namespace AlexLimon404\TgInfoBugs\Facades;

use Illuminate\Support\Facades\Facade;

class TgInfoBugs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tg-info-bugs';
    }
}
