<?php
/**
 * Created by PhpStorm.
 * User: gurik
 * Date: 06.10.2018
 * Time: 8:03
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;

    /**
     * @ORM\Column(type="integer", length=1, nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="Test")
     * @ORM\JoinTable(name="tests_questions",
     *      joinColumns={@ORM\JoinColumn(name="question_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="test_id", referencedColumnName="id")}
     *      )
     */
    private $tests;
    
    /**
     * @ORM\OneToMany(targetEntity="QuestionVariants", mappedBy="question")  
     */
    private $questionVariants;

    /**
     * @ORM\OneToMany(targetEntity="UserTestResult", mappedBy="question")  
     */
    private $usersTestsResults;

    public function __construct()
    {
        $this->tests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Question
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add test
     *
     * @param \AppBundle\Entity\Test $test
     *
     * @return Question
     */
    public function addTest(\AppBundle\Entity\Test $test)
    {
        $this->tests[] = $test;

        return $this;
    }

    /**
     * Remove test
     *
     * @param \AppBundle\Entity\Test $test
     */
    public function removeTest(\AppBundle\Entity\Test $test)
    {
        $this->tests->removeElement($test);
    }

    /**
     * Get tests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * Add questionVariant
     *
     * @param \AppBundle\Entity\QuestionVariants $questionVariant
     *
     * @return Question
     */
    public function addQuestionVariant(\AppBundle\Entity\QuestionVariants $questionVariant)
    {
        $this->questionVariants[] = $questionVariant;

        return $this;
    }

    /**
     * Remove questionVariant
     *
     * @param \AppBundle\Entity\QuestionVariants $questionVariant
     */
    public function removeQuestionVariant(\AppBundle\Entity\QuestionVariants $questionVariant)
    {
        $this->questionVariants->removeElement($questionVariant);
    }

    /**
     * Get questionVariants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestionVariants()
    {
        return $this->questionVariants;
    }

    /**
     * Add usersTestsResult
     *
     * @param \AppBundle\Entity\UserTestResult $usersTestsResult
     *
     * @return Question
     */
    public function addUsersTestsResult(\AppBundle\Entity\UserTestResult $usersTestsResult)
    {
        $this->usersTestsResults[] = $usersTestsResult;

        return $this;
    }

    /**
     * Remove usersTestsResult
     *
     * @param \AppBundle\Entity\UserTestResult $usersTestsResult
     */
    public function removeUsersTestsResult(\AppBundle\Entity\UserTestResult $usersTestsResult)
    {
        $this->usersTestsResults->removeElement($usersTestsResult);
    }

    /**
     * Get usersTestsResults
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersTestsResults()
    {
        return $this->usersTestsResults;
    }
}
