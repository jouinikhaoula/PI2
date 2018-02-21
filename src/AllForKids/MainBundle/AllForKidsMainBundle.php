<?php

namespace AllForKids\MainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AllForKidsMainBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
