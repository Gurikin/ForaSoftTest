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
     * @ORM\OneToMany(targetEntity="Question", mappedBy="variants")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $question;

    /**
     * @ORM\OneToOne(targetEntity="Answer", inversedBy="variant")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id", nullable=false)
     */
    private $answer;
}