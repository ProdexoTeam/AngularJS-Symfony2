<?php

namespace BackOffice\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BackOfficeUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
