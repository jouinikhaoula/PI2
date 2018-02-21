<?php

namespace AllForKids\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function ShowAction()
    {
        return $this->render('@AllForKidsMain/Admin/show.html.twig', array(
            // ...
        ));
    }

}
