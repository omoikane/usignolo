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
use Symfony\Component\HttpFoundation\Request;
use Usignolo\Bundle\UsignoloBundle\Entity\Issue;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Route("/", name="_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UsignoloBundle:Issue');

        $issues = $repository->findAll();

        $issue = new Issue();

        $form = $this->createFormBuilder($issue)
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($issue);
            $em->flush();

            return $this->redirect($this->generateUrl('_welcome'));
        }

        return array(
            'issues' => $issues,
            'form' => $form->createView(),
        );
    }
}
