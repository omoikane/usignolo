<?php

/*
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
use Usignolo\Bundle\UsignoloBundle\Form\Type\IssueType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Home controller.
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class DashboardController extends Controller
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The HTTP Request.
     * @return array
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $issue = new Issue();

        $form = $this->createForm(new IssueType(), $issue);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($issue);
            $em->flush();

            return $this->redirect($this->generateUrl('usignolo_usignolo_dashboard_index'));
        }

        $repository = $em->getRepository('UsignoloBundle:Issue');
        $issues = $repository->findAll();

        return array(
            'issues' => $issues,
            'form' => $form->createView(),
        );
    }
}
