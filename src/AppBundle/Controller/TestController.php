<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Service\TestService;
use AppBundle\Entity\Test;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\DataMapper\CheckboxListMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
     * @param $testId, $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($testId, Request $request)
    {
        //Setup & handle of submit form block
        $testServ = new TestService();

        $form = $this->createFormBuilder(array('message' => 'content'))
            ->setAction($this->generateUrl('test_submit'))
            ->setMethod('POST')
            ->add('testId', HiddenType::class, array('data' => $testId))
            ->add('test_submit', SubmitType::class, array('label' => 'Проверить ответы'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tid = $request->request->get('form')['testId'];
            $source = $this->getTestList($tid);
            $result = $request->request->get('Q');
            $result = $testServ->checkTest($source, $result);
            return $this->render('test/test_result.html.twig', array(
                'testResult' => $result
            ));
        }

        //Get data from DB
        $testList = $this->getTestList($testId);

        //Output block
        return $this->render('test/index.html.twig', array(
                'test' => $testList['test'],
                'questionsTestList'=> $testList['questionsTestList'],
                'questionVariantsList' => $testList['questionVariantsList'],
                'questionsCount' => $testList['questionsCount'],
                'questionTypeList' => $testList['questionTypeList'],
                'form' => $form->CreateView()
            )
        );
    }

    /**
     * @Route("/test/testSubmit", name="test_submit")
     * Method=({"POST"})
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function submitTestAction(Request $request) {
        return $this->render('test/test_result.html.twig', array(
            'request' => $request->request->get('Q')
        ));
    }

    private function getTestList($testId) {
        //Get data from DB
        $testRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Test');
        $test = $testRepository->find($testId);
        $questionsTestList = ($test != null) ? $test->getQuestions() : array();
        foreach ($questionsTestList as $question) {
            $questionVariantsList[] = ($question != null) ? $question->getVariants() : array();
            $questionTypeList[] = ($question != null) ? $question->getType() : array();
        }
        $questionsCount = count($questionsTestList);
        //Form Array for data exchange
        $testList = array(
            'test' => $test,
            'questionsTestList'=> $questionsTestList,
            'questionVariantsList' => $questionVariantsList,
            'questionsCount' => $questionsCount,
            'questionTypeList' => $questionTypeList
        );
        return $testList;
    }
}