<?php

namespace BackOffice\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOffice\SchoolBundle\Document\Eleve;
use BackOffice\SchoolBundle\Form\EleveType;


class EleveController extends Controller {

    public function getIndexAction() {

        $dm = $this->get('doctrine_mongodb')->getManager();

        $eleve = $dm->getRepository('BackOfficeSchoolBundle:Eleve')
                ->findAll();


        return $eleve;
    }

    //////////////////////////// return Json ////////////////////////////////////////////////
//     public function JsonAction() {
//        $dm = $this->get('doctrine_mongodb')->getManager();
//
//        $eleve = $dm->getRepository('BackOfficeSchoolBundle:Eleve')->findAll();
//        $retour = array();
//        foreach ($eleve as $key => $value) {
//
//            $retour[$key]["id"] = $value->getId();
//            $retour[$key]["name"] = $value->getName();
//            $retour[$key]["classe"] = $value->getClasse()->getName();
//        }
//
//        $response = json_encode($retour);
//        return new Response($response, 200, array('Content-Type' => 'application/json'));
//         // var_dump($response);exit;
//    }

    public function addAction() {

        $request = $this->get('request');
        $var = $request->query->get("valeur");
        if ($request->getMethod() == 'GET') {
            $eleve = new Eleve();
            $eleve->setName($var);
            $em = $this->get('doctrine_mongodb')->getManager();
            $em->persist($eleve);
            $em->flush();
            return $eleve;
        }
    }
    
        public function newAction() {
        $eleve = new Eleve();
        $form = $this->createForm(new EleveType(), $eleve);

        return $this->render('BackOfficeSchoolBundle:Eleve:new.html.twig', array(
                    'test' => $eleve,
                    'form' => $form->createView()
        ));
    }

}
