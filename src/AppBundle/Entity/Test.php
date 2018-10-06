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
 * @ORM\Table(name="test")
 */
class Test
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
    private $name="Test 1";


    /**
     * @ORM\ManyToMany(targetEntity="Question")
     * @JoinTable(name="users_groups",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     */


    /**
     * @ORM\ManyToMany(targetEntity="Question")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $questions;
}