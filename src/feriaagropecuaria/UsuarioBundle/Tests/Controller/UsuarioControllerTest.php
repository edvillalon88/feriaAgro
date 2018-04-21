<?php

namespace feriaagropecuaria\UsuarioBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsuarioControllerTest extends WebTestCase
{
    public function test\login()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/\login');
    }

}
