<?php

/**
 * This file is part of Usignolo.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usignolo\Bundle\UsignoloBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * IssueType.
 */
class IssueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('description', 'textarea', array('required' => false))
            ->add('save', 'submit');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'issue';
    }
}
