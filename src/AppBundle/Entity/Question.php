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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\QuestionRepository")
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
     * @ORM\ManyToMany(targetEntity="Test", mappedBy="questions")
     */
    private $tests;

//    /**
//     * @ORM\OneToMany(targetEntity="Variant", mappedBy="question")
//     */
    /**
     * @ORM\OneToMany(targetEntity="Variant", mappedBy="question")
     */
    private $variants;

    /**
     * @ORM\OneToMany(targetEntity="UserTestResult", mappedBy="question")
     */
    private $usersTestsResults;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tests = new \Doctrine\Common\Collections\ArrayCollection();
        $this->variants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usersTestsResults = new \Doctrine\Common\Collections\ArrayCollection();
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
        switch ($this->type) {
            case 1: return "checkbox";
            case 2: return "radio";
            case 3: return "text";
            default: return $this->type;
        }
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
     * Add variant
     *
     * @param \AppBundle\Entity\Variant $variant
     *
     * @return Question
     */
    public function addVariant(\AppBundle\Entity\Variant $variant)
    {
        $this->variants[] = $variant;

        return $this;
    }

    /**
     * Remove variant
     *
     * @param \AppBundle\Entity\Variant $variant
     */
    public function removeVariant(\AppBundle\Entity\Variant $variant)
    {
        $this->variants->removeElement($variant);
    }

    /**
     * Get variants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVariants()
    {
        return $this->variants;
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
