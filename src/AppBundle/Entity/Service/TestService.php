<?php
/**
 * Created by PhpStorm.
 * User: gurik
 * Date: 11.10.2018
 * Time: 23:28
 */

namespace AppBundle\Entity\Service;


class TestService
{
    /**
     * @param $source
     * @param array $result
     * @return array $generalResult
     */
    public function checkTest($source, array $result) {
        $userRight = "You was right in here.";
        $userFalse = "Wrong!";
        $right = "";
        $generalResult = array();
        foreach ($source['questionsTestList'] as $question) {
            foreach ($question->getVariants() as $variant) {
                $content = $variant->getContent();
                if (in_array ($content , $result[$question->getId()])) {
                    if ($variant->getRight()) {
//                        $addArr = array($content,$userRight);
                        $right = $userRight;
                    } else {
//                        $addArr = array($content,$userFalse);
                        $right = $userFalse;
                    }
                } else {
                    $right = ($variant->getRight()) ? "Right variant." : "";
                    $right = ($question->getType() == "text") ? $userFalse : $right;
//                    $addArr = array($content,$right);
                }
                $generalResult[$question->getContent()][$variant->getContent()] = $right;
            }
        }
        return $generalResult;
    }
}