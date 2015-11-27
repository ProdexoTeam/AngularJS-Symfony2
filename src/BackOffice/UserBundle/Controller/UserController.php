<?php

namespace BackOffice\UserBundle\Controller;

use BackOffice\UserBundle\Document\User;
use BackOffice\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {

    public function indexAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $documents = $dm->getRepository('BackOfficeUserBundle:User')->findAll();
        return $this->render('BackOfficeUserBundle:User:index.html.twig', array('documents' => $documents));
    }

    public function addAction() {

        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {

            $form->bind($request);
            //echo "<pre>";print_r($page);exit;
            if ($form->isValid()) {
                $em = $this->get('doctrine_mongodb')->getManager();
                $user->setRoles(array());
                $em->persist($user);
                $em->flush();
                return $this->redirect($this->generateUrl('back_office_user_homepage'));
            } else {
                echo $form->getErrors();
            }
        }
        return $this->render('BackOfficeUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }

}
