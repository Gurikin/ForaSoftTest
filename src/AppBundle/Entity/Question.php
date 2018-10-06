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
     * @ORM\ManyToMany(targetEntity="Test", mappedBy="questions")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id", nullable=false)
     */
    private $tests;

    /**
     * @ORM\ManyToOne(targetEntity="Variant", inversedBy="question")
     * @ORM\JoinColumn(name="variant_id", referencedColumnName="id", nullable=false)
     */
    private $variants;

    /**
     * @ORM\ManyToOne(targetEntity="Answer", inversedBy="question")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id", nullable=false)
     */
    private $answers;
}