<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users_tests_results")
 */
class UserTestResult {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usersTestsResults")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Test", inversedBy="usersTestsResults")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id", nullable=false)
     */
    private $test;
    
    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="usersTestsResults")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $question;
    
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $result;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateTime;

    /**
     * @ORM\Column(type="string", length=100, unique=true, nullable=false)
     */
    private $session;

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
     * Set result
     *
     * @param boolean $result
     *
     * @return UserTestResult
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return boolean
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     *
     * @return UserTestResult
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserTestResult
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set test
     *
     * @param \AppBundle\Entity\Test $test
     *
     * @return UserTestResult
     */
    public function setTest(\AppBundle\Entity\Test $test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \AppBundle\Entity\Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set question
     *
     * @param \AppBundle\Entity\Question $question
     *
     * @return UserTestResult
     */
    public function setQuestion(\AppBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \AppBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
