<?php

namespace BackOffice\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOffice\SchoolBundle\Document\Classe;
use BackOffice\SchoolBundle\Form\ClasseType;

class ClasseController extends Controller {

    public function indexAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        
        $classe = $dm->getRepository('BackOfficeSchoolBundle:Classe')
                ->findAll();
        
        return $this->render('BackOfficeSchoolBundle:Classe:index.html.twig', array('classes' => $classe));
    }

    public function addAction() {
        $classe = new Classe();
        $form = $this->createForm(new ClasseType(), $classe);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {

            $form->bind($request);
            //echo "<pre>";print_r($page);exit;
            if ($form->isValid()) {
                $em = $this->get('doctrine_mongodb')->getManager();
                $em->persist($classe);
                $em->flush();
                return $this->redirect($this->generateUrl('classe'));
            } else {
                echo $form->getErrors();
            }
        }
        return $this->render('BackOfficeSchoolBundle:Classe:add.html.twig', array('form' => $form->createView()));
    }

}
