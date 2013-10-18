<?php

/*
 * This file is part of Usignolo.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usignolo\Bundle\UsignoloBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IssueControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/issue/');
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET /issue/"
        );
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(
            array(
                'usignolo_issue[title]'       => 'Test',
                'usignolo_issue[description]' => 'Foo Bar Test',
            )
        );

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(
            0,
            $crawler->filter('td:contains("Test")')->count(),
            'Missing element td:contains("Test")'
        );

        // Check dashboard
        $dashboard = $client->request('GET', '/');
        $this->assertGreaterThan(
            0,
            $dashboard->filter('li:contains("Test")')->count(),
            'Missing element li:contains("Test") in dashboard'
        );

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(
            array(
                'usignolo_issue[title]'       => 'Edited',
                'usignolo_issue[description]' => 'Edited Foo Bar',
                'usignolo_issue[complete]'    => true,
            )
        );

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $field_title = $crawler->filter('[name="usignolo_issue[title]"]');
        $this->assertGreaterThan(0, $field_title->count(), 'Missing element [name="usignolo_issue[title]"]');
        $this->assertEquals('Edited', $field_title->attr('value'), 'Element [name="usignolo_issue[title]"] is not updated');

        $field_description = $crawler->filter('[name="usignolo_issue[description]"]');
        $this->assertGreaterThan(0, $field_description->count(), 'Missing element [name="usignolo_issue[description]"]');
        $this->assertEquals('Edited Foo Bar', $field_description->html(), 'Element [name="usignolo_issue[description]"] is not updated');

        $field_complete = $crawler->filter('[name="usignolo_issue[complete]"]');
        $this->assertGreaterThan(0, $field_complete->count(), 'Missing element [name="usignolo_issue[complete]"]');
        $this->assertEquals('checked', $field_complete->attr('checked'), 'Element [name="usignolo_issue[complete]"] is not updated');

        // Check dashboard
        $dashboard = $client->request('GET', '/');
        $this->assertEquals(
            0,
            $dashboard->filter('li:contains("Test")')->count(),
            'Found element li:contains("Test") (should be complete) in dashboard'
        );

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
