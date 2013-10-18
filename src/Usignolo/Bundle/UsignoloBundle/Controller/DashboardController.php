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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function indexAction()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('UsignoloBundle:Issue');
        $issues = $repository->findBy(array('complete' => false));

        return array(
            'issues' => $issues,
        );
    }
}
