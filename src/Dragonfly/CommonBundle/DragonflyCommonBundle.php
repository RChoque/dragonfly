<?php

namespace Dragonfly\CommonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DragonflyCommonBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
