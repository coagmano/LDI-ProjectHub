<?php

namespace LDI\ProjectHubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LDI\ProjectHubBundle\Entity\Project;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LDIProjectHubBundle:Default:index.html.twig');
        $project = findProjectById($id);
    }

    public function projectAction($id)
    {
        $project = findProjectById($id);
        $users = $project->getUsers();
        foreach ($users as $key => $value) {
            $value->getFirstName();
        }

    }
}
