<?php

/*
 * This file is part of Usignolo.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usignolo\Bundle\UsignoloBundle\Tests\Entity;

use Usignolo\Bundle\UsignoloBundle\Entity\Issue;

class IssueTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSetTitle()
    {
        $issue = new Issue();

        $issue->setTitle('There is an issue!');

        $this->assertEquals('There is an issue!', $issue->getTitle());
    }

    public function testGetSetDescription()
    {
        $issue = new Issue();

        $issue->setDescription('<p>And there is a description too.</p>');

        $this->assertEquals('<p>And there is a description too.</p>', $issue->getDescription());
    }
}
