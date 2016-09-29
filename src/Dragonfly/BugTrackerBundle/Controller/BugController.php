<?php

namespace Dragonfly\BugTrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BugController extends Controller
{
    public function indexAction(Request $request, $project)
    {
        $em = $this->getDoctrine()->getManager();
        // $projectRepository = $em->getRepository('DragonflyCommonBundle:Project');
        $bugRepository = $em->getRepository('DragonflyBugTrackerBundle:Bug');
        
        $query = $bugRepository->findAllByProject($project);

        $pagination_nb_elements = $this->container->getParameter('pagination_nb_elements');

        $paginator = $this->get('knp_paginator');
        $bugs = $paginator->paginate($query, $request->query->getInt('page', 1), $pagination_nb_elements);

        return $this->render('DragonflyBugTrackerBundle:Bug:index.html.twig', array("bugs"=>$bugs));
    }
}
