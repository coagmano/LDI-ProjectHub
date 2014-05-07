<?php

namespace LDI\ProjectHubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LDIProjectHubBundle:Default:index.html.twig', array('name' => $name));
    }
}
