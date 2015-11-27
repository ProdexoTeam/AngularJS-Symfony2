<?php

namespace BackOffice\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOffice\SchoolBundle\Document\Eleve;
use BackOffice\SchoolBundle\Form\EleveType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class EleveController extends Controller {

    public function indexAction() {

        $dm = $this->get('doctrine_mongodb')->getManager();

        $eleve = $dm->getRepository('BackOfficeSchoolBundle:Eleve')
                ->findAll();
        

        return $this->render('BackOfficeSchoolBundle:Eleve:index.html.twig', array('eleves' => $eleve));
    }
    
    //////////////////////////// return Json ////////////////////////////////////////////////
    
     public function JsonAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $eleve = $dm->getRepository('BackOfficeSchoolBundle:Eleve')->findAll();
        $retour = array();
        foreach ($eleve as $key => $value) {

            $retour[$key]["id"] = $value->getId();
            $retour[$key]["name"] = $value->getName();
            $retour[$key]["classe"] = $value->getClasse()->getName();
        }

        $response = json_encode($retour);
        return new Response($response, 200, array('Content-Type' => 'application/json'));
         // var_dump($response);exit;
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
