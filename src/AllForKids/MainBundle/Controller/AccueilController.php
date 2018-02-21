<?php

namespace AllForKids\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function AccueilAction()
    {
        return $this->render('@AllForKidsMain/Accueil/accueil.html.twig', array(

        ));
    }

}
