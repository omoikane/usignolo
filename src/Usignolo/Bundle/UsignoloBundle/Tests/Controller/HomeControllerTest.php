<?php

/**
 * Questo file è parte di usignolo.
 *
 * @author    Daniele De Nobili
 * @copyright Web Agency Meta Line S.r.l.
 * @package   ???
 */

namespace Usignolo\Bundle\UsignoloBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk(), 'The home page response must be "OK".');
    }
}
