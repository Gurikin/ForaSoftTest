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
     * @ORM\OneToMany(targetEntity="QuestionVariants", mappedBy="variant")  
     */
    private $questionVariants;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questionVariants = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add questionVariant
     *
     * @param \AppBundle\Entity\QuestionVariants $questionVariant
     *
     * @return Variant
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
}
