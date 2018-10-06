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
 * @ORM\Table(name="answer")
 */
class Answer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $question;

    /**
     * @ORM\OneToOne(targetEntity="Variant", mappedBy="answer")
     * @ORM\JoinColumn(name="variant_id", referencedColumnName="id", nullable=false)
     */
    private $variant;
}