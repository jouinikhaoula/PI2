<?php

namespace AllForKids\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BabySitterController extends Controller
{
    public function ShowAction()
    {
        return $this->render('@AllForKidsMain/BabySitter/showBabyS.html.twig', array(
            // ...
        ));
    }

}
