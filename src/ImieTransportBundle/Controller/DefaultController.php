<?php

namespace ImieTransportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ImieTransportBundle:Default:index.html.twig');
    }
}
