<?php

namespace BackOffice\UserBundle\Listener;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityListener {

    protected $router;
    protected $securityContext;

    public function __construct(EngineInterface $templating, RouterInterface $router, SecurityContextInterface $securityContext) {
        $this->templating = $templating;
        $this->router = $router;
        $this->securityContext = $securityContext;
    }

    public function onKernelRequest(GetResponseEvent $event = null) {
        $request = $event->getRequest();
        $path = explode("/", $request->getPathInfo());
        if (isset($path[1]) && $path[1] == "usermanagement") {
            if ($this->securityContext->getToken() != null) {
                $token = $this->securityContext->getToken();
                $user = $token->getUser();
                $roles = $user->getGroups()->getRoles();
                $valid = true;
                $route = $event->getRequest()->attributes->get('_route');
                foreach ($roles as $role) {
                    $routeStudnent = array(strtolower($role));
                    if (!in_array($route, $routeStudnent)) {
                        $valid = false;
                    }
                    if (!$valid) {
                        $response = new Response();
                        $response->setContent(
                                // create you custom template AcmeFooBundle:Exception:exception.html.twig
                                $this->templating->render(
                                        'BackOfficeUserBundle:Exception:403.html.twig', array('code' => 403)
                                )
                        );
                        $event->setResponse($response);
                    }
                }
            }
        }
    }

}
