<?php

namespace M2mobi\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use M2mobi\UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template("M2mobiUserBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/signup")
     * @Template("M2mobiUserBundle:Default:signup.html.twig")
     */
    public function signupAction(Request $request)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('firstname', 'text')
            ->add('lastname', 'text')
            ->add('username', 'text')
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('birthDate', 'birthday', array(
                'format' => 'dd - MMMM - yyyy',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-70)
            ))
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                // encrypting the password
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $salt = $user->getSalt();
                $password = $encoder->encodePassword($user->getPassword(), $salt);
                $user->setPassword($password);
                $user->setSalt($salt);

                // inserting the user
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('welcome'));
            }
        }

        return array('form' => $form->createView());
    }


    /**
     * @Route("/welcome")
     * @Template("M2mobiUserBundle:Default:welcome.html.twig")
     */
    public function welcomeAction()
    {
        return array();
    }
}

