<?php

namespace BackOffice\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOffice\UserBundle\Form\RoleType;

class RoleController extends Controller {

    public function editAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $group = $dm->getRepository('BackOfficeUserBundle:Group')->find($id);
//        $form = $this->createForm(new GroupType(), $group);

        $form = $this->createForm(new RoleType(), $group, array('roles' => $this->container->getParameter('security.role_hierarchy.roles')));
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->get('doctrine_mongodb')->getManager();
                $em->persist($group);
                $em->flush();
                return $this->redirect($this->generateUrl('back_office_group_homepage'));
            } else {
                echo $form->getErrors();
            }
        }

        return $this->render('BackOfficeUserBundle:Role:index.html.twig', array('group' => $group, 'form' => $form->createView()));
    }

}
