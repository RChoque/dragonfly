<?php

namespace Dragonfly\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Dragonfly\CommonBundle\Entity\Project;
use Dragonfly\CommonBundle\Form\Type\ProjectType;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('DragonflyCommonBundle:Default:index.html.twig');
    }


}
