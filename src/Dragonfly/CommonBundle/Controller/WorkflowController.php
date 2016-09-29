<?php

namespace Dragonfly\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Dragonfly\CommonBundle\Entity\Workflow;
use Dragonfly\CommonBundle\Form\Type\ProjectType;

class WorkflowController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $workflowRepository = $em->getRepository('DragonflyCommonBundle:Workflow');
        $query = $workflowRepository->findAll();

        $pagination_nb_elements = $this->container->getParameter('pagination_nb_elements');

        $paginator = $this->get('knp_paginator');
        $workflows = $paginator->paginate($query, $request->query->getInt('page', 1), $pagination_nb_elements);

        return $this->render('DragonflyCommonBundle:Workflow:list.html.twig', array("workflows"=>$workflows));
    }

    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $workflowRepository = $em->getRepository('DragonflyCommonBundle:Workflow');
        $workflow = $workflowRepository->findOneById($id);

        return $this->render('DragonflyCommonBundle:Workflow:show.html.twig', array("workflow"=>$workflow));
    }

    public function createAction(Request $request)
    {
        $workflow = new Workflow();
        $form = $this->handleForm($request, $workflow);

        if($form instanceof RedirectResponse){
            return $form;
        }

        return $this->render('DragonflyCommonBundle:Workflow:update.html.twig', array("form" => $form->createView()));
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $workflowRepository = $em->getRepository('DragonflyCommonBundle:Workflow');
        $workflow = $workflowRepository->findOneById($id);
        $form = $this->handleForm($request, $workflow);

        if($form instanceof RedirectResponse){
            return $form;
        }
        
        return $this->render('DragonflyCommonBundle:Workflow:update.html.twig', array("form" => $form->createView(), "workflow" => $workflow));
    }

    private function handleForm(Request $request, $workflow){
        $form = $this->createForm(ProjectType::class, $workflow);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($workflow);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'workflow enregistré.');
                return $this->redirect($this->generateUrl('dragonfly_common_workflow_list', array()));
            }else{
                $request->getSession()->getFlashBag()->add('error', 'Erreur.');
            }
        }

        return $form;
    }
}