<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 27/10/17
 * Time: 11:13
 */

namespace ImieTransportBundle\EventListener;

use UserBundle\Entity\User;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\DependencyInjection\Container;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class CharteListener
{

    protected $router;

    protected $container;

    protected $tokenStorage;

    /**
     * CharteListener constructor.
     * @param $router
     * @param $container
     * @param $tokenStorage
     */
    public function __construct(Router $router, Container $container, TokenStorage $tokenStorage)
    {
        $this->router = $router;
        $this->container = $container;
        $this->tokenStorage = $tokenStorage;
    }

    public function onKernelController(GetResponseEvent $event) {

        if (!$event->isMasterRequest() || !$this->tokenStorage->getToken()) {
            return;
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if (!$user instanceof User) {
            return;
        }

        $event->getRequest()->get('_route');
        if(!$user->getAcceptCharte() && $event->getRequest()->get('_route') != 'imie_transport_chartre') {

            $url = $this->router->generate('imie_transport_chartre');
            $event->setResponse(new RedirectResponse($url));
        }
    }
}