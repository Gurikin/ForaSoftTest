<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Test;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\DataMapper\CheckboxListMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TestController extends Controller
{
    /**
     * @Route("/test/{testId}", name="test_pass")
     * @param $testId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($testId)
    {
        $testRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Test');
        $test = $testRepository->find($testId);
        $questionsTestList = $test->getQuestions();
        foreach ($questionsTestList as $question) {
            $questionVariantsList[] = $question->getVariants();
            $questionTypeList[] = $question->getType();
        }
        $questionsCount = count($questionsTestList);

        return $this->render('test/index.html.twig', array(
                'test' => $test,
                'questionsTestList'=> $questionsTestList,
                'questionVariantsList' => $questionVariantsList,
                'questionsCount' => $questionsCount,
                'questionTypeList' => $questionTypeList
            )
        );
    }

    /**
     * @Route("/test/checkTest", name="test_check", methods={"POST"})
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkTestAction(Request $request) {
        return $this->render('default/index.html.twig');
    }
}
