<?php

namespace Dragonfly\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Dragonfly\CommonBundle\Entity\Project;
use Dragonfly\CommonBundle\Entity\Member;
use Dragonfly\CommonBundle\Form\Type\ProjectType;

class ProjectController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('DragonflyCommonBundle:Project');
        $query = $projectRepository->findAll();

        $pagination_nb_elements = $this->container->getParameter('pagination_nb_elements');

        $paginator = $this->get('knp_paginator');
        $projects = $paginator->paginate($query, $request->query->getInt('page', 1), $pagination_nb_elements);

        return $this->render('DragonflyCommonBundle:Project:list.html.twig', array("projects"=>$projects));
    }

    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('DragonflyCommonBundle:Project');
        $project = $projectRepository->findOneById($id);

        return $this->render('DragonflyCommonBundle:Project:show.html.twig', array("project" => $project));
    }

    public function createAction(Request $request)
    {
        $project = new Project();
        $project->addMember(new Member());
        var_dump($project);
        $form = $this->handleForm($request, $project);

        if($form instanceof RedirectResponse){
            return $form;
        }

        return $this->render('DragonflyCommonBundle:Project:update.html.twig', array("form" => $form->createView()));
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('DragonflyCommonBundle:Project');
        $project = $projectRepository->findOneById($id);
        $form = $this->handleForm($request, $project);

        if($form instanceof RedirectResponse){
            return $form;
        }
        
        return $this->render('DragonflyCommonBundle:Project:update.html.twig', array("form" => $form->createView(), "project" => $project));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('DragonflyCommonBundle:Project');
        $project = $projectRepository->findOneById($id);

        $delete_form = $this->createForm(new DeleteType(), $project);
        $delete_form->handleRequest($request);

        if ($delete_form->isValid()) {
            if ($delete_form->get('yes')->isClicked()) {
                // if(count($jobType->getJobs())>0){
                //     $request->getSession()->getFlashBag()->add('error', 'Suppression impossible : Il y a '.count($jobType->getJobs()).' annonces associée à ce type de poste.');
                //     return $this->render('MazediaCareerBundle:Admin/JobType:show.html.twig', array("delete_form" => $delete_form->createView(), "type" => $jobType));
                // }else{
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($project);
                    $em->flush();
                // }
            }
            return $this->redirect($this->generateUrl('dragonfly_common_project_list', array()));
        }

        return $this->render('DragonflyCommonBundle:Project:show.html.twig', array("delete_form" => $delete_form->createView(), "project" => $project));
    }

    private function handleForm(Request $request, $project){
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'projet enregistré.');
                return $this->redirect($this->generateUrl('dragonfly_common_project_list', array()));
            }else{
                $request->getSession()->getFlashBag()->add('error', 'Erreur.');
            }
        }

        return $form;
    }
}
