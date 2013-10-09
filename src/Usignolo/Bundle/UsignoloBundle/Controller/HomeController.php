<?php

/**
 * Questo file è parte di usignolo.
 *
 * @author    Daniele De Nobili
 * @copyright Web Agency Meta Line S.r.l.
 * @package   ???
 */

namespace Usignolo\Bundle\UsignoloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Route("/", name="_home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
