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
}