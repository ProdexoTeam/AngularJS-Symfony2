<?php

namespace BackOffice\UserBundle\Controller;

use BackOffice\UserBundle\Document\Group;
use BackOffice\UserBundle\Form\GroupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GroupController extends Controller {

    public function indexAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $group = $dm->getRepository('BackOfficeUserBundle:Group')->findAll();
        return $this->render('BackOfficeUserBundle:Group:index.html.twig', array('documents' => $group));
    }

    public function addAction() {

        $group = new Group($name =null, $roles = array());
        $form = $this->createForm(new GroupType(), $group);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {

            $form->bind($request);
            //echo "<pre>";print_r($page);exit;
            if ($form->isValid()) {
                $em = $this->get('doctrine_mongodb')->getManager();
                $group->setRoles(array());
                $em->persist($group);
                $em->flush();
                return $this->redirect($this->generateUrl('back_office_group_homepage'));
            } else {
                echo $form->getErrors();
            }
        }
        return $this->render('BackOfficeUserBundle:Group:add.html.twig', array('form' => $form->createView()));
    }

}
