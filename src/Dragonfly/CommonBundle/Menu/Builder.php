<?php

namespace Dragonfly\CommonBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if (is_object($user) && !$user instanceof UserInterface) {

            $em = $this->container->get('doctrine')->getManager();
            //$totalPost = 10; //$this->get('repository.post')->count();

            // -------------------------------
            // Dashboard
            // -------------------------------

            $menu->addChild('dashboard', array(
                    'label' => 'Tableau de bord',
                    'route' => 'dragonfly_common_dashboard',
                    'attributes' => array(
                        'icon' => 'fa fa-tachometer'
                    )
                )
            );

            $menu->addChild('my_projects', array(
                    'label' => 'Mes projets',
                    // 'route' => 'dragonfly_common_user_projects',
                    'attributes' => array(
                        'icon' => 'fa fa-tachometer'
                    )
                )
            );

            // -------------------------------
            // PROJECT
            // -------------------------------

            $menu->addChild('admin', array(
                    'label' => 'Administration',
                    'attributes' => array(
                        'dropdown' => true,
                        'icon' => 'fa fa-gear',
                        //'badge' => $totalPost,
                        //'badge_class' => 'label-info'
                    )
                )
            );

            $menu['admin']->addChild('Projets', array(
                    'route' => 'dragonfly_common_project_list',
                    'attributes' => array(
                        'icon' => 'fa fa-list-ul',
                    )
                )
            );

            $menu['admin']->addChild('Workflows', array(
                    'route' => 'dragonfly_common_workflow_list',
                    'attributes' => array(
                        'icon' => 'fa fa-list-ul',
                    )
                )
            );

            // // -------------------------------
            // // CANDIDATE
            // // -------------------------------

            // $menu->addChild('candidate', array(
            //         'label' => 'Candidats',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-users',
            //         )
            //     )
            // );

            // $menu['candidate']->addChild('Ajouter un candidat', array(
            //         'route' => 'mazedia_career_admin_candidate_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-user-plus'
            //         )
            //     )
            // );

            // $menu['candidate']->addChild('Liste des candidats', array(
            //         'route' => 'mazedia_career_admin_candidate_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // // -------------------------------
            // // CANDIDACY
            // // -------------------------------

            // $menu->addChild('candidacy', array(
            //         'label' => 'Candidatures',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-balance-scale',
            //         )
            //     )
            // );

            // $menu['candidacy']->addChild('Ajouter une candidature', array(
            //         'route' => 'mazedia_career_admin_candidacy_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-plus'
            //         )
            //     )
            // );

            // $menu['candidacy']->addChild('Liste des candidatures', array(
            //         'route' => 'mazedia_career_admin_candidacy_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // // -------------------------------
            // // SOCIETY
            // // -------------------------------

            // $menu->addChild('society', array(
            //         'label' => 'Entreprises',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-university',
            //         )
            //     )
            // );

            // $menu['society']->addChild('Ajouter une entreprise', array(
            //         'route' => 'mazedia_career_admin_society_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-plus'
            //         )
            //     )
            // );

            // $menu['society']->addChild('Liste des entreprises', array(
            //         'route' => 'mazedia_career_admin_society_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // // -------------------------------
            // // PAGE
            // // -------------------------------

            // $menu->addChild('page', array(
            //         'label' => 'Pages',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-file-o',
            //         )
            //     )
            // );

            // $menu['page']->addChild('Ajouter une page', array(
            //         'route' => 'mazedia_career_admin_page_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-plus'
            //         )
            //     )
            // );

            // $menu['page']->addChild('Liste des pages', array(
            //         'route' => 'mazedia_career_admin_page_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // // -------------------------------
            // // CONTRACT TYPE
            // // -------------------------------

            // $menu->addChild('contract_type', array(
            //         'label' => 'Type de contrats',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-files-o',
            //         )
            //     )
            // );

            // $menu['contract_type']->addChild('Ajouter un type de contrat', array(
            //         'route' => 'mazedia_career_admin_contract_type_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-plus'
            //         )
            //     )
            // );

            // $menu['contract_type']->addChild('Liste des types de contrat', array(
            //         'route' => 'mazedia_career_admin_contract_type_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // // -------------------------------
            // // JOB TYPE
            // // -------------------------------

            // $menu->addChild('job_type', array(
            //         'label' => 'Type de postes',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-briefcase',
            //         )
            //     )
            // );

            // $menu['job_type']->addChild('Ajouter un type de poste', array(
            //         'route' => 'mazedia_career_admin_job_type_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-plus'
            //         )
            //     )
            // );

            // $menu['job_type']->addChild('Liste des types de poste', array(
            //         'route' => 'mazedia_career_admin_job_type_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // // -------------------------------
            // // JOB IMAGE
            // // -------------------------------

            // $menu->addChild('job_image', array(
            //         'label' => 'Images d\'annonce',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-picture-o',
            //         )
            //     )
            // );

            // $menu['job_image']->addChild('Ajouter une image', array(
            //         'route' => 'mazedia_career_admin_job_image_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-plus'
            //         )
            //     )
            // );

            // $menu['job_image']->addChild('Liste des images', array(
            //         'route' => 'mazedia_career_admin_job_image_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // // -------------------------------
            // // NEWSLETTER
            // // -------------------------------

            // $menu->addChild('newsletter', array(
            //         'label' => 'Newsletter',
            //         'attributes' => array(
            //             'dropdown' => true,
            //             'icon' => 'fa fa-envelope',
            //         )
            //     )
            // );

            // $menu['newsletter']->addChild('Ajouter un abonné', array(
            //         'route' => 'mazedia_career_admin_newsletter_create',
            //         'attributes' => array(
            //             'icon' => 'fa fa-plus'
            //         )
            //     )
            // );

            // $menu['newsletter']->addChild('Liste des abonnés', array(
            //         'route' => 'mazedia_career_admin_newsletter_list',
            //         'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            // $menu->addChild('Traduction', array(
            //     'route' => 'lexik_translation_grid',
            //     'attributes' => array(
            //             'icon' => 'fa fa-list-ul',
            //         )
            //     )
            // );

            
        }
        return $menu;
    }

}
