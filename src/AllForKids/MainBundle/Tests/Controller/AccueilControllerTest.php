<?php

namespace AllForKids\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccueilControllerTest extends WebTestCase
{
    public function testAccueil()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Accueil');
    }

}
