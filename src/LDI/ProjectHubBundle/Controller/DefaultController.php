<?php

namespace LDI\ProjectHubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LDI\ProjectHubBundle\Entity\Project;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LDIProjectHubBundle:Default:index.html.twig');
    }

    public function projectAction($id)
    {
        
        
        foreach ($users as $key => $value) {
            $value->getFirstName();
        }

    }
}
