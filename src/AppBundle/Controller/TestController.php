<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Test;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;

class TestController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function indexAction($testId=null)
    {
        $testRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Test');
        $test = new Test();
        $questionRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Question');
        if ($testId == null) {
            $testsList = $testRepository->findAll();
        } else {
            $testsList = $testRepository->find($testId);
            $questionsTestList = $test->getQuestions();
        }
        var_dump($questionsTestList);
        $testsRowsCount = (count($testsList)%3 == 0) ? count($testsList)/3 : count($testsList)/3+1;

        return $this->render('default/index.html.twig', array(
            'testsList' => $testsList,
            'testsCount'=> $testsRowsCount
            )
        );

//        SELECT content, `type`, `name` FROM fora_soft_test.question as q,
//				fora_soft_test.test as t
//                INNER JOIN fora_soft_test.tests_questions as tq
//                where tq.question_id=q.id
//    and t.id = 1;

//        #$videos = $em->createQueryBuilder('v')
//        #            ->add('select', 'v, c')
//        #           ->add('from', 'YourBundle:Video v')
//        #          ->leftJoin('YourBundle:Comment', 'c')
//        #         ->where('v.comment = c.id')
//        #        ... // some other conditions if you need
//        #       ->getQuery()
//        #      ->getResult();
    }
}
