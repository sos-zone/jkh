<?php

namespace JKHBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JKHBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //$_SESSION["is_auth"] = false;
        if ($_SESSION["is_auth"] == true) {
            return $this->render('JKHBundle:Default:index.html.twig',
                                    array('is_auth' => true,
                                            'name' => "Сергей" )
                                );
        }
        else { 
            return $this->render('JKHBundle:Default:index.html.twig',
                                    array('is_auth' => false ) 
                                );
        }

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

    public function authfinAction()
    {
        $indentNum = '3075482a111pb5';
        $litzSchet = 1252232;
        $email = 'new_word@tut.by';
        $pass = "12345";
        $fio = "Ivanov Sergei";


        $User = new User();
        $User->setIndentNum($indentNum);
        $User->setLitzSchet($litzSchet);
        $User->setEmail($email);
        $User->setPass($pass);
        $User->setFio($fio);


        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($User);
        $em->flush();

        return new Response('Created User id '.$User->getId());
        //return $this->render('JKHBundle:Default:auth5.html.twig');
    }

    public function recoverypassAction()
    {
        $email = trim($_POST["email"]);
        
        $User = $this->getDoctrine()
        ->getRepository('JKHBundle:User')
        ->findOneBy(array('email' => $email));


        if (!$User) {
            return new Response('Данного email не найдено');
        }
        else {
            $Indentnum = $User->getIndentNum();
            return new Response('Индентификационный номер = '.$Indentnum);            
        }

        /* Отправка Секретного кода на восстановление пароля */
        /*
        $recepient = "new_word@tut.by";
        $sitename = "JKH";

        $email = trim($_POST["email"]);
        $message ="Email: $email \n Воостановление пароля";
        $pagetitle ="Запрос на восстановление пароля с сайта \"$sitename\"";
        mail($recepient,$pagetitle,$message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");

        //mail("new_word@tut.by", "My Subject", "Line 1\nLine 2\nLine 3");
        */
    }

    public function loginAction()
    {
        $email = trim($_POST["email"]);
        $pass = trim($_POST["pass"]);
        
        $User = $this->getDoctrine()
        ->getRepository('JKHBundle:User')
        ->findOneBy(array('email' => $email, 'pass' => $pass));


        if (!$User) {
            $_SESSION["is_auth"] = false;
            return new Response('Повторите попытку');
        }
        else {
            $_SESSION["is_auth"] = true;
            //$request = $this->getRequest();
            //$fio = $User->getFio();
            //return new Response('Добро пожаловать сэр '.$fio.' '.$request);
            
            //return $this->redirect($this->generateUrl('jkh_homepage'));

            $response = $this->forward('JKHBundle:Default:index.html.twig',
                                    array('is_auth' => true,
                                            'name' => "Сергей" ));
            return $response;
        }
    }

    public function logoutAction()
    {
        $_SESSION["is_auth"] = false;
        return new Response('До свидания'); 
    }
}
