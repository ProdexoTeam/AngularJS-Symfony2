<?php

namespace BackOffice\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOffice\SchoolBundle\Document\Eleve;
use BackOffice\SchoolBundle\Form\EleveType;

class EleveController extends Controller {

    public function indexAction() {

        $dm = $this->get('doctrine_mongodb')->getManager();

        $eleve = $dm->getRepository('BackOfficeSchoolBundle:Eleve')
                ->findAll();

        return $this->render('BackOfficeSchoolBundle:Eleve:index.html.twig', array('eleves' => $eleve));
    }

    public function addAction() {
        $eleve = new Eleve();
        $form = $this->createForm(new EleveType(), $eleve);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {

            $form->bind($request);
            //echo "<pre>";print_r($page);exit;
            if ($form->isValid()) {
                $em = $this->get('doctrine_mongodb')->getManager();
                $em->persist($eleve);
                $em->flush();
                return $this->redirect($this->generateUrl('eleve'));
            } else {
                echo $form->getErrors();
            }
        }
        return $this->render('BackOfficeSchoolBundle:Eleve:add.html.twig', array('form' => $form->createView()));
    }

}
