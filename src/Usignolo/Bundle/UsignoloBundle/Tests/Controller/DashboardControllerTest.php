<?php

/*
 * This file is part of Usignolo.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usignolo\Bundle\UsignoloBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk(), 'The home page response must be "OK".');
    }

    public function testSubmitIssueForm()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/');

        $issues_count = $crawler->filter('#issues-list li')->count();

        $form = $crawler->selectButton('issue_save')->form();

        $form['issue[title]'] = 'A simple title';
        $form['issue[description]'] = 'A simple description';

        $crawler = $client->submit($form);

        $this->assertEquals($issues_count + 1, $crawler->filter('#issues-list li')->count());
    }
}
