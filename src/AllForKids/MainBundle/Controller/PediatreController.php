<?php

namespace AllForKids\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PediatreController extends Controller
{
    public function ShowAction()
    {
        return $this->render('@AllForKidsMain/Pediatre/showPediatre.html.twig', array(
            // ...
        ));
    }

}
