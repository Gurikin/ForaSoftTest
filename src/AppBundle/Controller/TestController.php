<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
//use AppBundle\Entity\Service\TestService;
use AppBundle\Entity\UserTestResult;
use AppBundle\Entity\User;
use AppBundle\Entity\Test;
use DateTime;
use Doctrine\DBAL\Driver\PDOException;
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
use Symfony\Component\HttpFoundation\Session\Session;
use FOS\UserBundle\Doctrine\UserManager;


class TestController extends Controller
{
    /**
     * @Route("/test/{testId}", name="test_pass")
     * @param $testId , $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($testId, Request $request)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
            ->getToken()
            ->getUser());
        if ($user == null) {
            return $this->render('user/user_miss.html.twig');
        }
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
            $result = $this->checkTest($source, $result, $user);
            return $this->render('test/test_result.html.twig', array(
                'testResult' => $result,
                'user' => $user
            ));
        }

        //Get data from DB
        $testList = $this->getTestList($testId);

        //Output block
        return $this->render('test/index.html.twig', array(
                'test' => $testList['test'],
                'questionsTestList' => $testList['questionsTestList'],
                'questionVariantsList' => $testList['questionVariantsList'],
                'questionsCount' => $testList['questionsCount'],
                'questionTypeList' => $testList['questionTypeList'],
                'user' => $user,
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
    public function submitTestAction(Request $request)
    {
        return $this->render('test/test_result.html.twig', array(
            'request' => $request->request->get('Q')
        ));
    }

    private function getTestList($testId)
    {
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
            'questionsTestList' => $questionsTestList,
            'questionVariantsList' => $questionVariantsList,
            'questionsCount' => $questionsCount,
            'questionTypeList' => $questionTypeList
        );
        return $testList;
    }

    /**
     * @param $source
     * @param array $result
     * @param $user
     * @return array
     */
    public function checkTest($source, array $result, $user)
    {
        //==========================================================================
        //Create the necessary objects
        $userTestResult = new UserTestResult();
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $userTestResult->setTest($source['test']);
        $userTestResult->setSession($session->getId());
        $date = new DateTime();
        $userTestResult->setUser($user);

        //==========================================================================
        //Create the array for the test_result form & fill the UserTestResult object
        $userRight = "You was right in here.";
        $userFalse = "Wrong!";
        $rightVariant = "Right variant.";
        $viewResult = array();
        foreach ($source['questionsTestList'] as $question) {
            $userTestResult->setQuestion($question);
            foreach ($question->getVariants() as $variant) {
                $userTestResult->setVariant($variant);
                $content = $variant->getContent();
                if (in_array($content, $result[$question->getId()])) {
                    if ($variant->getRight()) {
                        $right = $userRight;
                    } else {
                        $right = $userFalse;
                    }
                } else {
                    $right = ($variant->getRight()) ? $rightVariant : "";
                    $right = ($question->getType() == "text") ? $userFalse : $right;
                }
                $viewResult[$question->getContent()][$variant->getContent()] = $right;
                $userTestResult->setResult($right);
                $userTestResult->setDateTime($date);
                $new_userTestResult = clone $userTestResult; //need for the insert instead update
                $em->persist($new_userTestResult);
                $em->flush();
            }
        }
        return $viewResult;
    }
}