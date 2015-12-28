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

    public function auth2Action()
    {
        return $this->render('JKHBundle:Default:auth2.html.twig');
    }

    public function auth3Action()
    {
        return $this->render('JKHBundle:Default:auth3.html.twig');
    }

    public function auth4Action()
    {
        return $this->render('JKHBundle:Default:auth4.html.twig');
    }

    public function auth5Action()
    {
        return $this->render('JKHBundle:Default:auth5.html.twig');
    }
}
