<?php

/*
 * This file is part of Usignolo.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usignolo\Bundle\UsignoloBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use Usignolo\Bundle\UsignoloBundle\Entity\Issue;
use Usignolo\Bundle\UsignoloBundle\Form\Type\IssueType;

class IssueTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'title' => 'A simple title',
            'description' => 'A simple description',
        );

        $issue = new Issue();

        $type = new IssueType();
        $form = $this->factory->create($type, $issue);

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($issue->getTitle(), $formData['title']);
        $this->assertEquals($issue->getDescription(), $formData['description']);
    }
}
