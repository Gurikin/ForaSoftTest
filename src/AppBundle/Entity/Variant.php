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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VariantRepository")
 * @ORM\Table(name="variant")
 */
class Variant
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $content;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $right;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="variants")
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="UserTestResult", mappedBy="variant")
     */
    private $usersTestsResults;
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return Variant
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
     * Set right
     *
     * @param boolean $right
     *
     * @return Variant
     */
    public function setRight($right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * Get right
     *
     * @return boolean
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set question
     *
     * @param \AppBundle\Entity\Question $question
     *
     * @return Variant
     */
    public function setQuestion(\AppBundle\Entity\Question $question = null)
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

    /**
     * Add usersTestsResult
     *
     * @param \AppBundle\Entity\UserTestResult $usersTestsResult
     *
     * @return Variant
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
