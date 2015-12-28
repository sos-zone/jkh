<?php

namespace JKHBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JKHBundle:Default:index.html.twig');
    }

    public function authAction()
    {
        return $this->render('JKHBundle:Default:auth.html.twig');
    }
}
