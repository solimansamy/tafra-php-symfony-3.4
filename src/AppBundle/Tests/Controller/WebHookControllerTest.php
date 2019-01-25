<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebHookControllerTest extends WebTestCase
{
    public function testMessenger()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'messenger');
    }

    public function testWhatsapp()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'whatsapp');
    }

}
