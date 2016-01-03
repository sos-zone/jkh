<?php

namespace JKHBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JKHBundle\Entity\User;
use JKHBundle\Entity\Etweet;

class DefaultController extends Controller
{
    public function check_auth($pagename)
    {
        if (!isset($_SESSION["is_auth"])) { $_SESSION["is_auth"] = false; }
        
        if ($_SESSION["is_auth"] == true) {
            return array('pname' => "JKHBundle:Default:$pagename",
                         'argum' => array('is_auth' => true,
                                            'name' => "Сергей" )
                         );
        }
        else {
            return array('pname' => "JKHBundle:Default:$pagename",
                         'argum' => array('is_auth' => false ) 
                        );                
        }

    }


    public function indexAction()
    {
        $answer = $this->check_auth('promo_new.html.twig');
        return $this->render($answer['pname'],$answer['argum']);
    }

    public function advertAction()
    {
        $answer = $this->check_auth('advert.html.twig');
        return $this->render($answer['pname'],$answer['argum']);
    }

    public function orgbaseAction()
    {
         $answer = $this->check_auth('catalog.html.twig');
        return $this->render($answer['pname'],$answer['argum']);
    }

    public function registrAction()
    {
        $indentNum = trim($_POST["indent_num"]);
        $litzSchet = trim($_POST["litz_schet"]);
        $email = trim($_POST["email"]);
        $pass = trim($_POST["pass"]);
        $fio = trim($_POST["fio"]);


        $User = new User();
        $User->setIndentNum($indentNum);
        $User->setLitzSchet($litzSchet);
        $User->setEmail($email);
        $User->setPass($pass);
        $User->setFio($fio);

        $checkmailcode = rand(); //случайное число для подтверждения email


        //Формируем сущность
        $Checker = new Checker();
        $Checker->setEmail($email);
        $Checker->setCheckmailcode($checkmailcode);


        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($User);
        $em->flush();

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($Checker);
        $em->flush();

        /* send confirm email */
        $recepient = $User->getEmail($email);
        $sitename = "JKH-SITE";
        $email = $User->getEmail($email);
        $message ="Для завершения регистрации пройдите пожалуйста по <a href=\"{{ path('_jkh_etweet') }}\">данной ссылке</a> \n либо вставте следующую строку: \n {{ path('_jkh_etweet') }} \n в адресную строку браузера и перейдите по ней на страницу подтверждения";
        $pagetitle ="Подтверждение регистрации с сайта \"$sitename\"";
        mail($recepient,$pagetitle,$message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");


        return new Response('Created User id '.$User->getId());
        //return $this->render('JKHBundle:Default:auth5.html.twig');        
    }

    public function checkemailAction($checkmailcode)
    {
        $Checker = $this->getDoctrine()
        ->getRepository('JKHBundle:Checker')
        ->findOneBy(array('checkmailcode' => $checkmailcode));

        if (!$Checker) {
            $_SESSION["is_auth"] = false;
            return new Response('К сожалению регистрационных данных не найдено. Повторите попытку');
        }
        else {
            $_SESSION["is_auth"] = true;
            //$request = $this->getRequest();
            //$fio = $User->getFio();
            //return new Response('Добро пожаловать сэр '.$fio.' '.$request);
            
            //return $this->redirect($this->generateUrl('jkh_homepage'));

            /*
            $response = $this->forward('JKHBundle:Default:index.html.twig',
                                    array('is_auth' => true,
                                            'name' => "Сергей" ));
            return $response;
            */
            return new Response('Спасибо за регистрацию. Добро пожаловать.');
        }
    }

    public function recoverypassAction()
    {
        $email = trim($_POST["email"]);
        
        $User = $this->getDoctrine()
        ->getRepository('JKHBundle:User')
        ->findOneBy(array('email' => $email));

        if (!$User) {
            return new Response('Данного email не найдено. Проверьте правильность написания.');
        }
        else {
            /* Отправка Секретного кода на восстановление пароля */
            $secretcode = rand(); //случайное число для подтверждения email
            $recepient = "new_word@tut.by";
            $sitename = "JKH-SITE";

            //Формируем сущность
            $Checker = new Checker();
            $Checker->setEmail($recepient);
            $Checker->setCheckmailcode($secretcode);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($Checker);
            $em->flush();


            $message = \Swift_Message::newInstance()
                    ->setSubject("Запрос на восстановление пароля с сайта $sitename")
                    ->setFrom('info@site.com')
                    ->setTo($recepient)
                    ->setBody(
                        $this->renderView(
                            'emails/forgetpassletter.html.twig',
                            array('sitename' => $sitename,
                                    'recepient' => $recepient,
                                    'secretcode' => $secretcode)
                        ),
                        'text/html'
                    )
                    ->addPart(
                        $this->renderView(
                            'emails/forgetpassletter.html.twig',
                            array('sitename' => $sitename,
                                    'recepient' => $recepient,
                                    'secretcode' => $secretcode)
                        ),
                        'text/plain'
                    )
            ;
            $this->get('mailer')->send($message);

            return new Response('На указанный емаил отправлены инструкции по восстановлению пароля');            
        }


        
    }

    public function recoverypassletterAction($checkmailcode)
    {
        //получаем значение email из запроса
        $request = $this -> getRequest();
        $email = $request->query->get('email');
        
        //сравниваем со значениями в БД
        $Checker = $this->getDoctrine()
        ->getRepository('JKHBundle:Checker')
        ->findOneBy(array('email' => $email, 'checkmailcode' => $checkmailcode));

        if (!$Checker) {
            return new Response('Данной заявки не найдено. Попробуйте повторить действия по восстановлению пароля заново.');
        }
        else {
            return $this->render('JKHBundle:Default:promo_new.html.twig',
                            array('is_auth' => false,
                                  'change_pass' => true )
                       );
        }
    }

        public function changepassAction()
    {
        $email = "new_word@tut.by";
        $pass = trim($_POST["pass"]);


        $em = $this->getDoctrine()->getEntityManager();
        $User = $em->getRepository('JKHBundle:User')->findOneBy(array('email' => $email, 'pass' => $pass));

        $User->setPass($pass);

        $em->flush();

        return $this->redirect($this->generateUrl('jkh_homepage'));
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

    public function etweetAction()
    {
        $etweetAddress = trim($_POST["etweet_address"]);
        $organizationId = trim($_POST["organization_id"]);
        $etweetAuthor = trim($_POST["etweet_author"]);
        $etweetAuthorAddress = trim($_POST["etweet_author_address"]);
        $etweetAuthorPhone = trim($_POST["etweet_author_phone"]);
        $etweetAuthorEmail = trim($_POST["etweet_author_email"]);
        $etweetAnswerToEmail = true;
        $etweetAnswerToPostadds = false;
        $etweetText = trim($_POST["etweet_text"]);
        $etweetFileName = "imagename.jpg";
        $etweetFilePath = "img/upload/";

/*
        $etweetAnswerToEmail = trim($_POST["etweet_answer_to_email"]);
        $etweetAnswerToPostadds = trim($_POST["etweet_answer_to_postadds"]);

        $etweetFileName = trim($_POST["etweet_file_name"]);
        $etweetFilePath = trim($_POST["etweet_file_name"]);
*/


        $Etweet = new Etweet();
        $Etweet->setEtweetAddress($etweetAddress);
        $Etweet->setOrganizationId($organizationId);
        $Etweet->setEtweetAuthor($etweetAuthor);
        $Etweet->setEtweetAuthorAddress($etweetAuthorAddress);
        $Etweet->setEtweetAuthorPhone($etweetAuthorPhone);
        $Etweet->setEtweetAuthorEmail($etweetAuthorEmail);
        $Etweet->setEtweetAnswerToEmail($etweetAnswerToEmail);
        $Etweet->setEtweetAnswerToPostadds($etweetAnswerToPostadds);
        $Etweet->setEtweetText($etweetText);
        $Etweet->setEtweetFileName($etweetFileName);
        $Etweet->setEtweetFilePath($etweetFilePath);


        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($Etweet);
        $em->flush();


        $Etweetid = $Etweet->getId();


        return new Response('ID Заявки: '.$Etweetid); 
    }    
}
