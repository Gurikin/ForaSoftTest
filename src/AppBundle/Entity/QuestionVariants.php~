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
    
}
