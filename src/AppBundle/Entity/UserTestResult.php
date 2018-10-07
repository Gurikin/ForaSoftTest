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
}
