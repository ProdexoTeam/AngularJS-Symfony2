<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// src/Acme/HelloBundle/Security/Firewall/ExceptionListener.php

namespace Back\DashBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Firewall\ExceptionListener as BaseExceptionListener;

class ExceptionListener extends BaseExceptionListener {

    protected function setTargetPath(Request $request) {
        // Ne conservez pas de chemin cible pour les requêtes XHR et non-GET
        // Vous pouvez ajouter n'importe quelle logique supplémentaire ici
        // si vous le voulez
        if ($request->isXmlHttpRequest() || 'POST' !== $request->getMethod()) {
            return;
        }
        echo $request->getUri();
        exit;
        $request->getSession()->set('_security.target_path', $request->getUri());
    }

}
