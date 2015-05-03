<?php

namespace Kartographerz\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KartographerzUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
