<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question_variants")
 */
class QuestionVariants {
        
    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="quesitonVariants")
     * @ORM\Id
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $question;
    
    /**
     * @ORM\ManyToOne(targetEntity="Variant", inversedBy="quesitonVariants")
     * @ORM\Id
     * @ORM\JoinColumn(name="variant_id", referencedColumnName="id", nullable=false)
     */
    private $variant;
    
    
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $right;
    

    /**
     * Set right
     *
     * @param boolean $right
     *
     * @return QuestionVariants
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
     * @return QuestionVariants
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

    /**
     * Set variant
     *
     * @param \AppBundle\Entity\Variant $variant
     *
     * @return QuestionVariants
     */
    public function setVariant(\AppBundle\Entity\Variant $variant)
    {
        $this->variant = $variant;

        return $this;
    }

    /**
     * Get variant
     *
     * @return \AppBundle\Entity\Variant
     */
    public function getVariant()
    {
        return $this->variant;
    }
}
