<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $testsList = $this->getDoctrine()
            ->getRepository('AppBundle:Test')
            ->findAll();
        if(empty($testsList)) {
            throw $this->createNotFoundException(
                "Sorry, but we don't have any tests for you now."
            );
        }
        $testsRowsCount = (count($testsList)%3 == 0) ? count($testsList)/3 : count($testsList)/3+1;

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
            ->getToken()
            ->getUser());

        return $this->render('default/index.html.twig', array(
                'testsList' => $testsList,
                'testsCount'=> $testsRowsCount,
                'user' => $user
            )
        );
    }
}
