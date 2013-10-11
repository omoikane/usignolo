<?php

/**
 * This file is part of Usignolo.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usignolo\Bundle\UsignoloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Usignolo\Bundle\UsignoloBundle\Entity\Issue;

class HomeController extends Controller
{
    /**
     * @Route("/", name="_home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UsignoloBundle:Issue');

        $issues = $repository->findAll();

        $form = $this->createFormBuilder(new Issue())
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('save', 'submit')
            ->getForm();

        return array(
            'issues' => $issues,
            'form' => $form->createView(),
        );
    }
}
